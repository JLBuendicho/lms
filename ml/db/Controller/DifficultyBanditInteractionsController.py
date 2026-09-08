from datetime import datetime
from mabwiser.mab import MAB, LearningPolicy
from pathlib import Path
from sqlalchemy import text
from typing import Optional
import globals
import joblib
import pandas as pd
import threading


class DifficultyBanditInteractionsController:
    MODEL_PATH = Path("models/tier_bandit.joblib")
    DIFFICULTY = ["easy", "medium", "hard"]
    CONTEXT_FIELDS = [
        "p_mastery",
        "skill_learn_rate",
        "n_attempts_this_skill",
        "recent_correctness_rate",
        "hours_since_last_practice",
    ]
    MIN_ROWS = 300  # rough floor: ~100 samples per arm for 3 arms, before a linear
    # contextual model has enough signal to beat random selection

    _lock = threading.Lock()
    _model: Optional[MAB] = None

    @classmethod
    def load_model(cls) -> Optional[MAB]:
        """
        Loads the latest batch-fitted model from disk. Call at startup and on a periodic reload
        so all uvicorn workers pick up refits without a restart.
        """
        with cls._lock:
            cls._model = (
                joblib.load(cls.MODEL_PATH) if cls.MODEL_PATH.exists() else None
            )

        return cls._model

    @classmethod
    def get_model(cls) -> Optional[MAB]:
        return cls._model

    @classmethod
    def predict_difficulty(cls, context: dict) -> Optional[str]:
        """
        Returns the model's chosen difficulty, or None if no model has been fitted yet
        — callers should fall back to random selection in that case.
        """
        model = cls.get_model()

        if model is None:
            return None

        ctx_vector = [context[field] for field in cls.CONTEXT_FIELDS]

        return model.predict(ctx_vector)[0]

    @classmethod
    def build_context(cls, student_id: int, skill_id: int) -> dict:
        """
        Builds the exact feature vector used both to select an arm (LinUCB predict)
        and to log the interaction (bandit_interactions.context). Called once at
        /bandit/select time; the resulting dict is round-tripped by the caller
        (Laravel) back into /bandit/outcome unchanged, so it never has to be
        rebuilt (and potentially drift) after the fact.
        """
        with globals.engine.connect() as conn:
            mastery_row = conn.execute(
                text(
                    "SELECT mastery FROM mastery_records WHERE user_id=:student_id AND skill_id=:skill_id"
                ),
                {"student_id": student_id, "skill_id": skill_id},
            ).fetchone()

            bkt_params = conn.execute(
                text(
                    "SELECT learns, `prior` FROM skill_bkt_params WHERE skill_id=:skill_id"
                ),
                {"skill_id": skill_id},
            ).fetchone()

            n_attempts = conn.execute(
                text(
                    "SELECT COUNT(*) FROM bandit_interactions WHERE student_id=:student_id AND skill_id=:skill_id"
                ),
                {"student_id": student_id, "skill_id": skill_id},
            ).scalar()

            recent = conn.execute(
                text("""SELECT correct FROM bandit_interactions
                        WHERE student_id=:student_id AND skill_id=:skill_id
                        ORDER BY created_at DESC LIMIT 5"""),
                {"student_id": student_id, "skill_id": skill_id},
            ).fetchall()

            last_attempt = conn.execute(
                text("""SELECT MAX(created_at) as last FROM bandit_interactions
                        WHERE student_id=:student_id AND skill_id=:skill_id"""),
                {"student_id": student_id, "skill_id": skill_id},
            ).fetchone()

        # cold-start defaults — first-ever attempt on this skill for this student
        p_mastery = mastery_row.mastery if mastery_row else bkt_params.prior

        recent_correctness_rate = (
            sum(r.correct for r in recent) / len(recent) if recent else 0.5
        )

        hours_since_last_practice = (
            (datetime.utcnow() - last_attempt.last).total_seconds() / 3600
            if last_attempt and last_attempt.last
            else 999.0
        )

        return {
            "p_mastery": float(p_mastery),
            "skill_learn_rate": float(bkt_params.learns),
            "n_attempts_this_skill": int(n_attempts),
            "recent_correctness_rate": float(recent_correctness_rate),
            "hours_since_last_practice": float(hours_since_last_practice),
        }

    @classmethod
    def refit(cls) -> None:
        df = pd.read_sql("SELECT * FROM bandit_interactions", globals.engine)

        if len(df) < cls.MIN_ROWS:
            print(f"Only {len(df)} rows logged (< {cls.MIN_ROWS}) — skipping refit.")
            return

        # normalize reward here, not at log time, so the normalization approach
        # can change between refits without touching already-logged rows
        df["reward_norm"] = (df["reward"] - df["reward"].mean()) / df["reward"].std()

        contexts = df["context"].apply(pd.Series)[cls.CONTEXT_FIELDS].values.tolist()

        mab = MAB(
            arms=cls.DIFFICULTY,
            learning_policy=LearningPolicy.LinUCB(alpha=1.0, scale=True),
        )
        mab.fit(
            decisions=df["arm"].tolist(),
            rewards=df["reward_norm"].tolist(),
            contexts=contexts,
        )

        cls.MODEL_PATH.parent.mkdir(exist_ok=True, parents=True)
        joblib.dump(mab, cls.MODEL_PATH)
        print(f"Refit complete on {len(df)} rows -> {cls.MODEL_PATH}")

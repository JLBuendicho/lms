import random
from fastapi import APIRouter
from pydantic import BaseModel

# from services.bandit_service import predict_tier, TIERS
from db.Controller.DifficultyBanditInteractionsController import (
    DifficultyBanditInteractionsController as BanditController,
)
from db.Models.DifficultyBanditInteractions import DifficultyBanditInteractions
from db import db

router = APIRouter(prefix="/difficulty-bandit")


# ---- /difficulty-bandit/select ----------------------------------------------------
# Laravel calls this right before serving an item. It gets back the arm to
# serve AND the exact context used — Laravel holds onto both (session/cache/
# hidden field) alongside the item, and sends them back unchanged to
# /difficulty-bandit/outcome once the student responds. Laravel never needs to know
# what's inside `context`; it's an opaque blob it round-trips.


class SelectRequest(BaseModel):
    student_id: int
    skill_id: int
    item_id: int


class SelectResponse(BaseModel):
    arm: str
    selection_source: str  # 'random' | 'model'
    context: dict


@router.post("/select", response_model=SelectResponse)
def select_arm(req: SelectRequest):
    context = BanditController.build_context(req.student_id, req.skill_id)
    difficulty = BanditController.predict_difficulty(context)

    if difficulty is None:  # no model fitted yet -> cold start / bootstrap phase
        return SelectResponse(
            arm=random.choice(BanditController.DIFFICULTY),
            selection_source="random",
            context=context,
        )

    return SelectResponse(arm=difficulty, selection_source="model", context=context)


# ---- /difficulty-bandit/outcome -----------------------------------------------------
# Laravel calls this after pyBKT has updated mastery from the student's response


class OutcomeRequest(BaseModel):
    student_id: int
    skill_id: int
    item_id: int
    arm: str
    selection_source: str
    context: dict
    previous_mastery: float
    correct: bool
    new_mastery: float


@router.post("/outcome")
def record_outcome(req: OutcomeRequest):
    reward = (
        req.new_mastery - req.previous_mastery
    )  # normalized later, in the batch refit job

    with db.getSession() as session:
        row = DifficultyBanditInteractions(
            student_id=req.student_id,
            skill_id=req.skill_id,
            item_id=req.item_id,
            arm=req.arm,
            selection_source=req.selection_source,
            context=req.context,
            previous_mastery=req.previous_mastery,
            correct=req.correct,
            new_mastery=req.new_mastery,
            reward=reward,
        )
        session.add(row)
        session.commit()

    return {"status": "logged"}


@router.get("/refit")
def refit_bandit_model():
    BanditController.refit()
    return {"message": "refit complete"}

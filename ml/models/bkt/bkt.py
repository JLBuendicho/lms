from db.Models.BktSkillParam import BktSkillParam
from pandas import DataFrame
from pyBKT.models import Model
from typing import Sequence
import time

model = Model(seed=42, num_fits=5)


# def getStructuredParamsList(df: DataFrame, skillParams: DataFrame):
#     paramsList = skillParams["value"].tolist()
#     skills = df["skill_name"].unique()

#     structuredParamsList = []
#     for i, skill in enumerate(skills):
#         base = i * 5
#         structuredParamsList.append(
#             {
#                 "skill_name": skill,
#                 "learn": paramsList[base],
#                 "forget": paramsList[base + 1],
#                 "guess": paramsList[base + 2],
#                 "slip": paramsList[base + 3],
#                 "prior": paramsList[base + 4],
#             }
#         )


#     return structuredParamsList
def getStructuredParamsList(df: DataFrame, skillParams: DataFrame):
    first_skill = df["skill_name"].iloc[0]
    print("first_skill: ")
    print(skillParams.loc[first_skill])
    skills = df["skill_name"].unique()
    structuredParamsList = []
    for skill in skills:
        skillDf = skillParams.loc[skill]
        structuredParamsList.append(
            {
                "skill_name": skill,
                "prior": skillDf.loc[("prior", "default"), "value"],
                "learn": skillDf.loc[("learns", "default"), "value"],
                "guess": skillDf.loc[("guesses", "default"), "value"],
                "slip": skillDf.loc[("slips", "default"), "value"],
                "forget": skillDf.loc[("forgets", "default"), "value"],
            }
        )
    return structuredParamsList


def trainModel(df):
    print(f"Training BKT on {len(df)} responses...", flush=True)

    start = time.perf_counter()

    model.fit(
        data=df,
        # forgets=True,
        forgets=False,
        defaults={
            "prior": 0.3,
            "guess": 0.25,
            "slip": 0.1,
        },
    )

    elapsed = time.perf_counter() - start

    print(
        f"BKT model.fit() finished in {elapsed:.2f} seconds",
        flush=True
    )

    bktSkillParams = model.params()
    print("bktSkillParams:")
    print(bktSkillParams)  # <-- add this
    print("bktSkillParams.columns:")
    print(bktSkillParams.columns)  # <-- and this

    print("Got BKT parameters.", flush=True)
    print(bktSkillParams, flush=True)

    return bktSkillParams


def sanitizeParams(bktSkillParamsDf):
    LEARN_MAX, GUESS_MAX, SLIP_MAX = 0.60, 0.35, 0.45
    # FORGET_MIN, FORGET_MAX = 0.01, 0.10
    SAFE_DEFAULTS = {"learns": 0.15, "guesses": 0.25, "slips": 0.10, "forgets": 0.0}

    # Pivot param_type into columns so every param lives in ONE dataframe,
    # indexed identically by construction -- avoids the alignment bug from
    # OR-ing four separately-sliced Series.
    wide = bktSkillParamsDf["value"].unstack(level=1)
    wide.index = wide.index.get_level_values(0)  # drop the trailing "class" level, keep skill name

    print("wide param table:")
    print(wide)

    diverged = (
        (wide["learns"] > LEARN_MAX) |
        (wide["guesses"] > GUESS_MAX) |
        (wide["slips"] > SLIP_MAX) # |
        # (wide["forgets"] < FORGET_MIN) |
        # (wide["forgets"] > FORGET_MAX)
    )

    print(diverged.value_counts())
    if diverged.any():
        print(f"WARNING: {diverged.sum()} skill(s) had degenerate BKT fits, "
              f"falling back to safe defaults: {diverged[diverged].index.tolist()}")

    bad_skills = diverged[diverged].index

    for param_name, safe_value in SAFE_DEFAULTS.items():
        bktSkillParamsDf.loc[(bad_skills, param_name, slice(None)), "value"] = safe_value

    return bktSkillParamsDf


# def sanitizeParams(bktSkillParamsDf):
#     LEARN_MAX, GUESS_MAX, SLIP_MAX = 0.60, 0.35, 0.45
#     FORGET_MIN, FORGET_MAX = 0.01, 0.10

#     learns = bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"]
#     guesses = bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"]
#     slips = bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"]
#     forgets = bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"]

#     # detect skills where the fit diverged (hit any bound)
#     diverged = (
#         (learns > LEARN_MAX) | (guesses > GUESS_MAX) |
#         (slips > SLIP_MAX) | (forgets < FORGET_MIN) | (forgets > FORGET_MAX)
#     )

#     # log which skills diverged so you can flag them for more data collection
#     if diverged.any():
#         print(f"WARNING: {diverged.sum()} skill(s) had degenerate BKT fits, "
#               f"falling back to safe defaults: {diverged[diverged].index.tolist()}")

#     # for diverged skills, use a SAFE default combo (not per-parameter clipping)
#     SAFE_DEFAULTS = {"learns": 0.15, "guesses": 0.25, "slips": 0.10, "forgets": 0.05}
#     for param_name, series in [("learns", learns), ("guesses", guesses),
#                                  ("slips", slips), ("forgets", forgets)]:
#         series.loc[diverged] = SAFE_DEFAULTS[param_name]

#     bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"] = learns
#     bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"] = guesses
#     bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"] = slips
#     bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"] = forgets

#     return bktSkillParamsDf


# def sanitizeParams(bktSkillParamsDf):
#     bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"] = (
#         bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"].clip(
#             upper=0.35
#         )
#     )
#     bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"] = (
#         bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"].clip(
#             upper=0.45
#         )
#     )
#     bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"] = (
#         bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"].clip(
#             upper=0.60
#         )
#     )
#     bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"] = (
#         bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"].clip(
#             lower=0.01, upper=0.10
#         )
#     )
#     return bktSkillParamsDf


# def sanitizeParams(bktSkillParamsDf):
#     bktSkillParamsDf['guess'] = bktSkillParamsDf['guess'].clip(upper=0.35)
#     bktSkillParamsDf['slip'] = bktSkillParamsDf['slip'].clip(upper=0.40)
#     return bktSkillParamsDf


def initializeMastery(userId: int, skillParams: Sequence[BktSkillParam]):
    masteryRecords = []

    for skillParam in skillParams:
        masteryRecords.append(
            {
                "user_id": userId,
                "skill_id": skillParam.skill_id,
                "skill_name": skillParam.skill_name,
                "mastery": skillParam.prior,
            }
        )

    return masteryRecords


def getNewMastery(prevMastery: float, isCorrect: bool, bktSkillParams: BktSkillParam):
    learn = bktSkillParams.learn
    guess = bktSkillParams.guess
    slip = bktSkillParams.slip

    print(f"Answer is Correct: {isCorrect}")
    if isCorrect:
        numerator = prevMastery * (1 - slip)
        denominator = numerator + ((1 - prevMastery) * guess)
    else:
        numerator = prevMastery * slip
        denominator = numerator + ((1 - prevMastery) * (1 - guess))

    if denominator == 0:
        posteriorKnowledge = prevMastery
        print(f"Posterior Knowledge = {prevMastery}")
    else:
        posteriorKnowledge = numerator / denominator
        if isCorrect:
            print(f"Posterior Knowledge = ({prevMastery} * (1 - {slip})) / ({numerator} + ((1 - {prevMastery}) * {guess}))")
        else:
            print(f"Posterior Knowledge = ({prevMastery} * {slip}) / ({numerator} + ((1 - {prevMastery}) * (1 - {guess})))")
        print(f"Posterior Knowledge = {posteriorKnowledge}")

    newMastery = posteriorKnowledge + ((1 - posteriorKnowledge) * learn)
    print(f"New Mastery = {posteriorKnowledge} + ((1 - {posteriorKnowledge}) * {learn})")
    print(f"New Mastery = {newMastery}")

    return newMastery

from db.Models.BktSkillParam import BktSkillParam
from pandas import DataFrame
from pyBKT.models import Model
from typing import Sequence

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
    model.fit(
        data=df,
        forgets=True,
        defaults={
            "prior": 0.3,
            "guess": 0.25,
            "slip": 0.1,
        },
    )
    bktSkillParams = model.params()
    print("bktSkillParams:")
    print(bktSkillParams)  # <-- add this
    print("bktSkillParams.columns:")
    print(bktSkillParams.columns)  # <-- and this
    return bktSkillParams


def sanitizeParams(bktSkillParamsDf):
    bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"] = (
        bktSkillParamsDf.loc[(slice(None), "guesses", slice(None)), "value"].clip(
            upper=0.35
        )
    )
    bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"] = (
        bktSkillParamsDf.loc[(slice(None), "slips", slice(None)), "value"].clip(
            upper=0.45
        )
    )
    bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"] = (
        bktSkillParamsDf.loc[(slice(None), "learns", slice(None)), "value"].clip(
            upper=0.60
        )
    )
    bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"] = (
        bktSkillParamsDf.loc[(slice(None), "forgets", slice(None)), "value"].clip(
            lower=0.01, upper=0.10
        )
    )
    return bktSkillParamsDf


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

    if isCorrect:
        numerator = prevMastery * (1 - slip)
        denominator = numerator + ((1 - prevMastery) * guess)
    else:
        numerator = prevMastery * slip
        denominator = numerator + ((1 - prevMastery) * (1 - guess))

    if denominator == 0:
        posteriorKnowledge = prevMastery
    else:
        posteriorKnowledge = numerator / denominator

    newMastery = posteriorKnowledge + ((1 - posteriorKnowledge) * learn)

    return newMastery

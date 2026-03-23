from pyBKT.models import Model

model = Model(seed=42, num_fits=5)


def getStructuredParamsList(df, skillParams):
    paramsList = skillParams["value"].tolist()
    skills = df["skill_name"].unique()

    structuredParamsList = []
    for i, skill in enumerate(skills):
        base = i * 5
        structuredParamsList.append(
            {
                "skill_name": skill,
                "learn": paramsList[base],
                "forget": paramsList[base + 1],
                "guess": paramsList[base + 2],
                "slip": paramsList[base + 3],
                "prior": paramsList[base + 4],
            }
        )

    return structuredParamsList


def trainModel(df):
    model.fit(data=df)

    bktSkillParams = model.params()

    return bktSkillParams


def initializeMastery(df, skillParams):
    userIds = df["user_id"].unique().tolist()

    masteryRecords = []

    for userId in userIds:
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

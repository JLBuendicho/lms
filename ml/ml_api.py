from db import db
from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Controller.UserController import UserController
from db.Controller.QuestionResponseController import QuestionResponseController
from fastapi import FastAPI
from models.bkt import bkt


app = FastAPI()
engine = db.getEngine()


# Endpoints ===
# Example endpoint
@app.get("/predict")
def predict(x: float):
    # Example dummy model
    y = 2 * x + 1
    return {"input": x, "prediction": y}


@app.get("/get-students")
def getStudents():
    return UserController.getStudents()


@app.get("/train-bkt")
def trainBkt():
    df = QuestionResponseController.getQuestionResponseDf()

    bktSkillParams = bkt.trainModel(df)

    print(bktSkillParams)

    structuredParamsList = bkt.getStructuredParamsList(
        df=df, skillParams=bktSkillParams
    )

    BktSkillParamsController.upsertBktSkillParams(
        structuredParamsList=structuredParamsList
    )

    return BktSkillParamsController.getBktSkillParams()


@app.get("/mastery-init")
def masteryInit():
    df = QuestionResponseController.getQuestionResponseDf()
    skillParams = BktSkillParamsController.getBktSkillParams()

    return bkt.initializeMastery(df=df, skillParams=skillParams)


# ===

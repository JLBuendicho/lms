from db import db
from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Controller.MasteryRecordsController import MasteryRecordsController
from db.Controller.UserController import UserController
from db.Controller.QuestionResponseController import QuestionResponseController
from fastapi import FastAPI
from models.bkt import bkt
import sqlalchemy.orm as orm


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
    with orm.Session(engine) as session:
        students = UserController.getStudents(session=session)

    return students


@app.get("/train-bkt")
def trainBkt():
    with orm.Session(engine) as session:
        df = QuestionResponseController.getQuestionResponsesDf()

        bktSkillParamsDf = bkt.trainModel(df)

        print(bktSkillParamsDf)

        structuredParamsList = bkt.getStructuredParamsList(
            df=df, skillParams=bktSkillParamsDf
        )

        BktSkillParamsController.upsertBktSkillParams(
            structuredParamsList=structuredParamsList, session=session
        )

        bktSkillParams = BktSkillParamsController.getBktSkillParams(session=session)

    return bktSkillParams


@app.get("/mastery-init")
def masteryInit():
    with orm.Session(engine) as session:
        unrecordedQuestionResponses = (
            QuestionResponseController.getUnrecordedQuestionResponses(session=session)
        )
        userIds = {
            unrecordedQuestionResponse.user_id
            for unrecordedQuestionResponse in unrecordedQuestionResponses
        }

        skillParams = BktSkillParamsController.getBktSkillParams(session=session)

        initialMasteryRecords = bkt.initializeMastery(
            userIds=userIds, skillParams=skillParams
        )
        MasteryRecordsController.upsertMasteryRecords(
            masteryRecords=initialMasteryRecords, session=session
        )

        MasteryRecordsController.updateMasteryRecords(
            unrecordedQuestionResponses=unrecordedQuestionResponses, session=session
        )

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords


# ===

from db.db import getEngine
from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Controller.MasteryRecordsController import MasteryRecordsController
from db.Controller.UserController import UserController
from db.Controller.QuestionResponseController import QuestionResponseController
from fastapi import FastAPI, BackgroundTasks
from models.bkt import bkt
import db.Models
import requests
import sqlalchemy.orm as orm

app = FastAPI()
engine = getEngine()
lmsUrl = "http://lms:8000"


def serialize(obj):
    data = obj.__dict__.copy()
    data.pop("_sa_instance_state", None)
    return data


# Endpoints ===
# Example endpoint
@app.get("/predict")
def predict(x: float):
    # Example dummy model
    y = 2 * x + 1
    return {"input": x, "prediction": y}


@app.get("/running-mastery-batch-updates-check")
def runningMasteryBatchUpdatesCheck():
    with orm.Session(engine) as session:
        runningMasteryBatchUpdates = (
            MasteryRecordsController.getRunningMasteryBatchUpdates(session=session)
        )

    return runningMasteryBatchUpdates


@app.get("/get-students")
def getStudents():
    with orm.Session(engine) as session:
        students = UserController.getStudents(session=session)

    return students


@app.get("/get-student-subject-ids")
def getStudentSubjectIds(userId: int):
    with orm.Session(engine) as session:
        subjectIds = UserController.getStudentSubjectIds(
            studentId=userId, session=session
        )

    return subjectIds


@app.get("/train-bkt")
def trainBkt():
    with orm.Session(engine) as session:
        df = QuestionResponseController.getQuestionResponsesDf()

        unsanitizedBktSkillParamsDf = bkt.trainModel(df)
        bktSkillParamsDf = bkt.sanitizeParams(bktSkillParamsDf=unsanitizedBktSkillParamsDf)

        print(bktSkillParamsDf)

        structuredParamsList = bkt.getStructuredParamsList(
            df=df, skillParams=bktSkillParamsDf
        )

        BktSkillParamsController.upsertBktSkillParams(
            structuredParamsList=structuredParamsList, session=session
        )

        bktSkillParams = BktSkillParamsController.getBktSkillParams(session=session)

    return bktSkillParams



@app.get("/get-subject-bkt-skill-params")
def getSubjectBktSkillParams():
    with orm.Session(engine) as session:
        subjectIds = [1, 2, 3]

        skillParams = BktSkillParamsController.getBktSkillParams(
            session=session, subjectIds=subjectIds
        )

    return skillParams


@app.get("/mastery-init")
def masteryInit(userId: int):
    with orm.Session(engine) as session:
        subjectIds = UserController.getStudentSubjectIds(
            studentId=userId, session=session
        )

        if not subjectIds:
            return []

        skillParams = BktSkillParamsController.getBktSkillParams(
            session=session, subjectIds=subjectIds
        )

        initialMasteryRecords = bkt.initializeMastery(
            userId=userId, skillParams=skillParams
        )
        MasteryRecordsController.upsertMasteryRecords(
            masteryRecords=initialMasteryRecords, session=session
        )

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords


@app.get("/update-mastery-record")
def updateMasteryRecord(questionResponseId: int):
    with orm.Session(engine) as session:
        questionResponse = QuestionResponseController.getQuestionResponse(
            questionResponseId=questionResponseId, session=session
        )
        bktSkillParams = BktSkillParamsController.getBktSkillParam(
            skillId=questionResponse.skill_id, session=session
        )

        MasteryRecordsController.updateMasteryRecord(
            questionResponse=questionResponse,
            bktSkillParams=bktSkillParams,
            session=session,
        )

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords


@app.get("/get-unrecorded-queston-responses")
def getUnrecordedQuestionResponses():
    with orm.Session(engine) as session:
        unrecordedQuestionResponses = (
            QuestionResponseController.getUnrecordedQuestionResponses(session=session)
        )

    return unrecordedQuestionResponses


def runBatchUpdateMasteryRecords(runId: int):
    callbackUrl = f"{lmsUrl}/api/mastery-batch-update-callback"

    try:
        with orm.Session(engine) as session:
            unrecordedQuestionResponses = (
                QuestionResponseController.getUnrecordedQuestionResponses(
                    session=session
                )
            )

            for questionResponse in unrecordedQuestionResponses:
                bktSkillParams = BktSkillParamsController.getBktSkillParam(
                    skillId=questionResponse.skill_id, session=session
                )
                MasteryRecordsController.updateMasteryRecord(
                    questionResponse=questionResponse,
                    bktSkillParams=bktSkillParams,
                    session=session,
                )

        requests.post(
            callbackUrl,
            json={"runId": runId, "status": "success", "error": None},
        )

    except Exception as e:
        requests.post(
            callbackUrl,
            json={"runId": runId, "status": "failed", "error": str(e)},
        )


@app.get("/update-mastery-records")
async def updateMasteryRecords(runId: int, background_tasks: BackgroundTasks):
    background_tasks.add_task(runBatchUpdateMasteryRecords, runId=runId)
    return {"message": "Batch update started", "runId": runId}


# ===


interruptedBatchUpdates = runningMasteryBatchUpdatesCheck()

if interruptedBatchUpdates:
    callbackUrl = f"{lmsUrl}/api/mastery-batch-update-callback"

    for interruptedBatchUpdate in interruptedBatchUpdates:
        requests.post(
            callbackUrl,
            json={
                "runId": interruptedBatchUpdate.id,
                "status": "failed",
                "error": "Network Interrupted",
            },
        )

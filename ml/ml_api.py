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


@app.get("/running-bkt-training-check")
def runningBktTrainingCheck():
    with orm.Session(engine) as session:
        runningBktTraining = (
            BktSkillParamsController.getRunningBktTraining(session=session)
        )

    return runningBktTraining


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


# @app.get("/train-bkt")
# def trainBkt():
#     with orm.Session(engine) as session:
#         df = QuestionResponseController.getQuestionResponsesDf()

#         unsanitizedBktSkillParamsDf = bkt.trainModel(df)
#         bktSkillParamsDf = bkt.sanitizeParams(bktSkillParamsDf=unsanitizedBktSkillParamsDf)

#         structuredParamsList = bkt.getStructuredParamsList(
#             df=df, skillParams=bktSkillParamsDf
#         )

#         BktSkillParamsController.upsertBktSkillParams(
#             structuredParamsList=structuredParamsList, session=session
#         )

#         bktSkillParams = BktSkillParamsController.getBktSkillParams(session=session)

#     return bktSkillParams

def runBktTraining(runId: int):
    callbackUrl = f"{lmsUrl}/api/bkt-training-callback"

    try:
        print("=== BKT TRAINING START ===", flush=True)

        with orm.Session(engine) as session:

            print("Getting question responses...", flush=True)

            df = QuestionResponseController.getQuestionResponsesDf()

            print(
                f"Got question responses: {len(df)} rows",
                flush=True
            )

            print("Starting BKT training...", flush=True)

            unsanitizedBktSkillParamsDf = bkt.trainModel(df)

            print("BKT training finished.", flush=True)

            bktSkillParamsDf = bkt.sanitizeParams(
                bktSkillParamsDf=unsanitizedBktSkillParamsDf
            )

            print("Parameters sanitized.", flush=True)

            structuredParamsList = bkt.getStructuredParamsList(
                df=df,
                skillParams=bktSkillParamsDf
            )

            print(
                f"Structured parameters: {len(structuredParamsList)}",
                flush=True
            )

            print("Upserting BKT parameters...", flush=True)

            BktSkillParamsController.upsertBktSkillParams(
                structuredParamsList=structuredParamsList,
                session=session
            )

            print("Upsert finished.", flush=True)

        print("=== BKT TRAINING END ===", flush=True)

        requests.post(
            callbackUrl,
            json={"runId": runId, "status": "success", "error": None},
        )

    except Exception as e:
        requests.post(
            callbackUrl,
            json={"runId": runId, "status": "failed", "error": str(e)},
        )

@app.get("/train-bkt")
async def trainBkt(runId: int, background_tasks: BackgroundTasks):
    background_tasks.add_task(runBktTraining, runId=runId)
    return {"message": "BKT training started", "runId": runId}


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


interruptedBktTraining = runningBktTrainingCheck()
interruptedBatchUpdates = runningMasteryBatchUpdatesCheck()

print(
    f"Interrupted BKT training runs: {len(interruptedBktTraining)}",
    flush=True
)
print(
    f"Interrupted mastery batch updates: {len(interruptedBatchUpdates)}",
    flush=True
)

if interruptedBktTraining:
    callbackUrl = f"{lmsUrl}/api/bkt-training-callback"

    for interruptedTraining in interruptedBktTraining:
        requests.post(
            callbackUrl,
            json={
                "runId": interruptedTraining.id,
                "status": "failed",
                "error": "Network Interrupted",
            },
        )

        print(
            f"Network interrupted during BKT training runId={interruptedTraining.id}. Marked as failed.",
            flush=True
        )

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

        print(
            f"Network interrupted during mastery batch update runId={interruptedBatchUpdate.id}. Marked as failed.",
            flush=True
        )

from db.Controller.UserController import UserController
from db.Controller.QuestionResponseController import QuestionResponseController
from fastapi import FastAPI
import routes.bkt_params as bkt_params
import routes.mastery_records as mastery_records
import globals
import requests
import sqlalchemy.orm as orm

app = FastAPI()
app.include_router(bkt_params.router)
app.include_router(mastery_records.router)


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


@app.get("/get-students")
def getStudents():
    with orm.Session(globals.engine) as session:
        students = UserController.getStudents(session=session)

    return students


@app.get("/get-student-subject-ids")
def getStudentSubjectIds(userId: int):
    with orm.Session(globals.engine) as session:
        subjectIds = UserController.getStudentSubjectIds(
            studentId=userId, session=session
        )

    return subjectIds



@app.get("/get-unrecorded-queston-responses")
def getUnrecordedQuestionResponses():
    with orm.Session(globals.engine) as session:
        unrecordedQuestionResponses = (
            QuestionResponseController.getUnrecordedQuestionResponses(session=session)
        )

    return unrecordedQuestionResponses


# ===


# Check for interrupted BKT training runs and mastery batch updates ===
interruptedBktTraining = bkt_params.runningBktTrainingCheck()
interruptedBatchUpdates = mastery_records.runningMasteryBatchUpdatesCheck()

print(f"Interrupted BKT training runs: {len(interruptedBktTraining)}", flush=True)
print(f"Interrupted mastery batch updates: {len(interruptedBatchUpdates)}", flush=True)

if interruptedBktTraining:
    callbackUrl = f"{globals.lmsUrl}/api/bkt-training-callback"

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
            flush=True,
        )

if interruptedBatchUpdates:
    callbackUrl = f"{globals.lmsUrl}/api/mastery-batch-update-callback"

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
            flush=True,
        )


# ===

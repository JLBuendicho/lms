from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Controller.MasteryRecordsController import MasteryRecordsController
from db.Controller.QuestionResponseController import QuestionResponseController
from db.Controller.UserController import UserController
from fastapi import APIRouter, BackgroundTasks
from models.bkt import bkt
import sqlalchemy.orm as orm
import globals

router = APIRouter(prefix="/mastery-records", tags=["Mastery Records"])


@router.get("/running-mastery-batch-updates-check")
def runningMasteryBatchUpdatesCheck():
    with orm.Session(globals.engine) as session:
        runningMasteryBatchUpdates = (
            MasteryRecordsController.getRunningMasteryBatchUpdates(session=session)
        )

    return runningMasteryBatchUpdates


@router.get("/mastery-init")
def masteryInit(userId: int):
    with orm.Session(globals.engine) as session:
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


@router.get("/update-mastery-record")
def updateMasteryRecord(questionResponseId: int):
    with orm.Session(globals.engine) as session:
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


@router.get("/update-mastery-records")
async def updateMasteryRecords(runId: int, background_tasks: BackgroundTasks):
    background_tasks.add_task(
        MasteryRecordsController.runBatchUpdateMasteryRecords, runId=runId
    )
    return {"message": "Batch update started", "runId": runId}

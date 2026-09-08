from db.Controller.BktSkillParamsController import BktSkillParamsController
from fastapi import APIRouter, BackgroundTasks
import sqlalchemy.orm as orm
import globals

router = APIRouter(prefix="/bkt-params", tags=["BKT Params"])


@router.get("/running-bkt-training-check")
def runningBktTrainingCheck():
    with orm.Session(globals.engine) as session:
        runningBktTraining = BktSkillParamsController.getRunningBktTraining(
            session=session
        )

    return runningBktTraining


@router.get("/train-bkt")
async def trainBkt(runId: int, background_tasks: BackgroundTasks):
    background_tasks.add_task(BktSkillParamsController.runBktTraining, runId=runId)
    return {"message": "BKT training started", "runId": runId}


@router.get("/get-subject-bkt-skill-params")
def getSubjectBktSkillParams():
    with orm.Session(globals.engine) as session:
        subjectIds = [1, 2, 3]

        skillParams = BktSkillParamsController.getBktSkillParams(
            session=session, subjectIds=subjectIds
        )

    return skillParams

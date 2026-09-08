from db.Controller.QuestionResponseController import QuestionResponseController
from db.Models.BktSkillParam import BktSkillParam, BktSkillParamSchema
from db.Models.Skill import Skill
from db.Models.Topic import Topic
from db.Models.Domain import Domain
from db.Models.Subject import Subject
from db.Models.BktTrainingLogs import BktTrainingLogs
from models.bkt import bkt
from sqlalchemy.orm import selectinload
import globals
import requests
import sqlalchemy as sa
import sqlalchemy.orm as orm


class BktSkillParamsController:
    @classmethod
    def __getBktParamSkillId(cls, param, session):
        bktParamSkillId = session.scalars(
            sa.select(Skill.id).where(Skill.name == param["skill_name"])
        ).first()

        return bktParamSkillId

    @classmethod
    def __getExistingBktSkillParam(cls, param, session):
        existingBktSkillParam = session.scalars(
            sa.select(BktSkillParam).where(BktSkillParam.skill_id == param["skill_id"])
        ).first()

        return existingBktSkillParam

    @classmethod
    def upsertBktSkillParams(cls, structuredParamsList, session):
        for param in structuredParamsList:
            param["skill_id"] = cls.__getBktParamSkillId(param=param, session=session)

            existing = cls.__getExistingBktSkillParam(param=param, session=session)

            if existing:
                # update
                existing.learn = param["learn"]
                existing.forget = param["forget"]
                existing.guess = param["guess"]
                existing.slip = param["slip"]
                existing.prior = param["prior"]
            else:
                # insert
                newParam = BktSkillParam(**param)
                session.add(newParam)

        session.commit()

    @classmethod
    def getBktSkillParams(cls, session, subjectIds="all"):
        if subjectIds == "all":
            bktSkillParams = session.scalars(sa.select(BktSkillParam)).all()
        else:
            bktSkillParams = session.scalars(
                sa.select(BktSkillParam)
                .join(BktSkillParam.skill)
                .join(Skill.topic)
                .join(Topic.domain)
                .join(Domain.subject)
                .where(Subject.id.in_([1, 2, 3]))
                .options(
                    selectinload(BktSkillParam.skill)
                    .selectinload(Skill.topic)
                    .selectinload(Topic.domain)
                    .selectinload(Domain.subject)
                )
            )

        return [BktSkillParamSchema.from_orm(param) for param in bktSkillParams]

    @classmethod
    def getBktSkillParam(cls, skillId, session):
        bktSkillParam = session.scalars(
            sa.select(BktSkillParam).where(BktSkillParam.skill_id == skillId)
        ).first()

        return bktSkillParam

    @classmethod
    def getRunningBktTraining(cls, session):
        runningBktTraining = session.scalars(
            sa.select(BktTrainingLogs).where(BktTrainingLogs.status == "running")
        ).all()

        return runningBktTraining

    @classmethod
    def runBktTraining(cls, runId: int):
        callbackUrl = f"{globals.lmsUrl}/api/bkt-training-callback"

        try:
            print("=== BKT TRAINING START ===", flush=True)
            with orm.Session(globals.engine) as session:
                print("Getting question responses...", flush=True)
                df = QuestionResponseController.getQuestionResponsesDf()
                print(f"Got question responses: {len(df)} rows", flush=True)

                print("Starting BKT training...", flush=True)
                unsanitizedBktSkillParamsDf = bkt.trainModel(df)
                print("BKT training finished.", flush=True)

                bktSkillParamsDf = bkt.sanitizeParams(
                    bktSkillParamsDf=unsanitizedBktSkillParamsDf
                )
                print("Parameters sanitized.", flush=True)

                structuredParamsList = bkt.getStructuredParamsList(
                    df=df, skillParams=bktSkillParamsDf
                )
                print(f"Structured parameters: {len(structuredParamsList)}", flush=True)

                print("Upserting BKT parameters...", flush=True)
                cls.upsertBktSkillParams(
                    structuredParamsList=structuredParamsList, session=session
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

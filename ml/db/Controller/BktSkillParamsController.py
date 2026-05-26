from db import db
from db.Models.BktSkillParam import BktSkillParam, BktSkillParamSchema
from db.Models.Skill import Skill
from db.Models.Topic import Topic
from db.Models.Domain import Domain
from db.Models.Subject import Subject
from sqlalchemy.orm import selectinload
import sqlalchemy as sa

engine = db.getEngine()


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

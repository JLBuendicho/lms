from db import db
from db.Models.Base import Base
from pydantic import BaseModel, ConfigDict
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# BktSkillParams Model
class BktSkillParam(Base):
    __table__ = sa.Table("bkt_skill_params", Base.metadata, autoload_with=engine)

    skill = orm.relationship("Skill", foreign_keys=lambda: [BktSkillParam.__table__.c.skill_id])


# Pydantic model for BktSkillParam
class BktSkillParamSchema(BaseModel):
    skill_id: int
    skill_name: str
    learn: float
    forget: float
    guess: float
    slip: float
    prior: float

    model_config = ConfigDict(from_attributes=True)
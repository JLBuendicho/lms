from db import db
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# Base Model
class Base(orm.DeclarativeBase):
    pass


# BktSkillParams Model
class BktSkillParam(Base):
    __table__ = sa.Table("bkt_skill_params", Base.metadata, autoload_with=engine)

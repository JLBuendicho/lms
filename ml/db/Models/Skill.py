from db import db
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# Base Model
class Base(orm.DeclarativeBase):
    pass


# Skill Model
class Skill(Base):
    __table__ = sa.Table("skills", Base.metadata, autoload_with=engine)

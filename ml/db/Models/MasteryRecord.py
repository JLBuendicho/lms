from db import db
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# Base Model
class Base(orm.DeclarativeBase):
    pass


# User Model
class MasteryRecord(Base):
    __table__ = sa.Table("mastery_records", Base.metadata, autoload_with=engine)

from db import db
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# Base Model
class Base(orm.DeclarativeBase):
    pass


# QuestionResponse Model
class QuestionResponse(Base):
    __table__ = sa.Table("question_responses", Base.metadata, autoload_with=engine)

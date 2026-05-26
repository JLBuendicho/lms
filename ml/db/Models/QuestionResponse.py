from db import db
from db.Models.Base import Base
import sqlalchemy as sa


engine = db.getEngine()


# QuestionResponse Model
class QuestionResponse(Base):
    __table__ = sa.Table("question_responses", Base.metadata, autoload_with=engine)

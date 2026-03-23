from db import db
from db.Models.QuestionResponse import QuestionResponse
import pandas as pd
import sqlalchemy as sa


engine = db.getEngine()


class QuestionResponseController:
    @classmethod
    def getQuestionResponseDf(cls):
        selectQuestionResponse = sa.select(
            QuestionResponse.user_id,
            QuestionResponse.skill_name,
            QuestionResponse.correct,
            QuestionResponse.order_id,
        )

        with engine.connect() as connection:
            df = pd.read_sql(selectQuestionResponse, connection)
        return df

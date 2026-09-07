from db import db
from db.Models.Base import Base
import sqlalchemy as sa

engine = db.getEngine()


# BktTrainingLogs Model
class BktTrainingLogs(Base):
    __table__ = sa.Table(
        "bkt_training_logs", Base.metadata, autoload_with=engine
    )

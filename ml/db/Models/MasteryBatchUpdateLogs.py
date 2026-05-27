from db import db
from db.Models.Base import Base
import sqlalchemy as sa

engine = db.getEngine()


# MasteryBatchUpdateLogs Model
class MasteryBatchUpdateLogs(Base):
    __table__ = sa.Table(
        "mastery_batch_update_logs", Base.metadata, autoload_with=engine
    )

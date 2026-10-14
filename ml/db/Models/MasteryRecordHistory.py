from datetime import datetime
from db import db
from db.Models.Base import Base
from pydantic import BaseModel, ConfigDict
import sqlalchemy as sa


engine = db.getEngine()


# MasteryRecordHistory Model
class MasteryRecordHistory(Base):
    __table__ = sa.Table("mastery_record_histories", Base.metadata, autoload_with=engine)


# Pydantic model for MasteryRecordHistory
class MasteryRecordHistorySchema(BaseModel):
    mastery_record_id: int
    previous_mastery: float
    new_mastery: float
    created_at: datetime
    updated_at: datetime

    model_config = ConfigDict(from_attributes=True)

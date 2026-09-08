from datetime import datetime
from db import db
from db.Models.Base import Base
from pydantic import BaseModel, ConfigDict
from typing import Optional
import sqlalchemy as sa

engine = db.getEngine()


# DifficultyBanditInteractions Model
class DifficultyBanditInteractions(Base):
    __table__ = sa.Table(
        "difficulty_bandit_interactions", Base.metadata, autoload_with=engine
    )


# Pydantic model for DifficultyBanditInteractions
class DifficultyBanditInteractionsSchema(BaseModel):
    id: Optional[int] = None
    student_id: int
    skill_id: int
    item_id: int
    arm: str
    selection_source: str
    context: dict
    previous_mastery: float
    correct: bool
    new_mastery: float
    reward: float
    created_at: Optional[datetime] = None
    updated_at: Optional[datetime] = None

    model_config = ConfigDict(from_attributes=True)

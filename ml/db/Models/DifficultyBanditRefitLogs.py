from db import db
from db.Models.Base import Base
import sqlalchemy as sa

engine = db.getEngine()


# DifficultyBanditRefitLogs Model
class DifficultyBanditRefitLogs(Base):
    __table__ = sa.Table(
        "difficulty_bandit_refit_logs", Base.metadata, autoload_with=engine
    )

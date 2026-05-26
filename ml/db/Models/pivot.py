from db import db
from db.Models.Base import Base
import sqlalchemy as sa

engine = db.getEngine()


# user_subject pivot table
user_subject = sa.Table(
    "subjects_user",
    Base.metadata,
    sa.Column("user_id", sa.Integer, sa.ForeignKey("users.id"), primary_key=True),
    sa.Column(
        "subjects_id", sa.Integer, sa.ForeignKey("subjects.id"), primary_key=True
    ),
    autoload_with=engine,
)

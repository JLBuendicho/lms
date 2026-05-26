from db import db
from db.Models.Base import Base
from db.Models.pivot import user_subject
import sqlalchemy as sa
import sqlalchemy.orm as orm

engine = db.getEngine()


class Subject(Base):
    __table__ = sa.Table("subjects", Base.metadata, autoload_with=engine)

    users = orm.relationship(
        "User",
        secondary=user_subject,
        primaryjoin=lambda: Subject.__table__.c.id == user_subject.c.subjects_id,
        secondaryjoin=lambda: (
            __import__("db.Models.User", fromlist=["User"]).User.__table__.c.id
            == user_subject.c.user_id
        ),
        back_populates="subjects",
    )

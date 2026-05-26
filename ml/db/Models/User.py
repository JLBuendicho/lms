from db import db
from db.Models.Base import Base
from db.Models.pivot import user_subject
import sqlalchemy as sa
import sqlalchemy.orm as orm

engine = db.getEngine()


class User(Base):
    __table__ = sa.Table("users", Base.metadata, autoload_with=engine)

    subjects = orm.relationship(
        "Subject",
        secondary=user_subject,
        primaryjoin=lambda: User.__table__.c.id == user_subject.c.user_id,
        secondaryjoin=lambda: (
            __import__("db.Models.Subject", fromlist=["Subject"]).Subject.__table__.c.id
            == user_subject.c.subjects_id
        ),
        back_populates="users",
    )

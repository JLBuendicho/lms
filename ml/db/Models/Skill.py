from db import db
from db.Models.Base import Base
import sqlalchemy as sa
import sqlalchemy.orm as orm

engine = db.getEngine()


class Skill(Base):
    __table__ = sa.Table("skills", Base.metadata, autoload_with=engine)

    topic = orm.relationship("Topic", foreign_keys=lambda: [Skill.__table__.c.topic_id])
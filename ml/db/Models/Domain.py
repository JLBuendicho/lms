from db import db
from db.Models.Base import Base
import sqlalchemy as sa
import sqlalchemy.orm as orm

engine = db.getEngine()


class Domain(Base):
    __table__ = sa.Table("domains", Base.metadata, autoload_with=engine)

    subject = orm.relationship("Subject", foreign_keys=lambda: [Domain.__table__.c.subject_id])
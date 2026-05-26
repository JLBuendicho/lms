from db import db
from db.Models.Base import Base
import sqlalchemy as sa
import sqlalchemy.orm as orm

engine = db.getEngine()


class Topic(Base):
    __table__ = sa.Table("topics", Base.metadata, autoload_with=engine)

    domain = orm.relationship("Domain", foreign_keys=lambda: [Topic.__table__.c.domain_id])
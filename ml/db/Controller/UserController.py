from db import db
from db.Models.User import User
import sqlalchemy as sa


engine = db.getEngine()


class UserController:
    @classmethod
    def getStudents(cls, session):
        students = session.scalars(sa.select(User).where(User.role == "student")).all()

        return {"students": students}

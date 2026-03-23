from db import db
from db.Models.User import User
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


class UserController:
    @classmethod
    def getStudents(cls):
        with orm.Session(engine) as session:
            students = session.scalars(
                sa.select(User).where(User.role == "student")
            ).all()
        return {"students": students}

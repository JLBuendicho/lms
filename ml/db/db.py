import os
import sqlalchemy as sa


def getEngine():
    DB_USER = os.environ.get("MYSQL_USER")
    DB_PASS = os.environ.get("MYSQL_PASSWORD")
    DB_HOST = os.environ.get("MYSQL_HOST", "db")
    DB_PORT = os.environ.get("MYSQL_PORT", 3306)
    DB_NAME = os.environ.get("MYSQL_DATABASE")

    DATABASE_URL = (
        f"mysql+pymysql://{DB_USER}:{DB_PASS}" f"@{DB_HOST}:{DB_PORT}/{DB_NAME}"
    )
    engine = sa.create_engine(DATABASE_URL, echo=True)

    return engine

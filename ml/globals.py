from db.db import getEngine
import os

engine = getEngine()
lmsUrl = os.getenv("LMS_URL", "http://lms:8000")  # use environment variable or default to dev URL

from db.db import getEngine
import os

engine = getEngine()
# lmsUrl = "http://lms:8000" # uncomment for dev
# lmsUrl = "http://nginx" # uncomment for prod
lmsUrl = os.getenv("LMS_URL", "http://lms:8000")  # use environment variable or default to dev URL

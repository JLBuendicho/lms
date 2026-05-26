from db.Models.pivot import user_subject  # no ORM deps, load first
from db.Models.User import User  # no relationship deps on Subject yet
from db.Models.Subject import Subject  # Subject.users references User, now safe

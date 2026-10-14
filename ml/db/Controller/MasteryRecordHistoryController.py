from datetime import datetime, timezone
from db.Models.MasteryRecordHistory import MasteryRecordHistory, MasteryRecordHistorySchema
import sqlalchemy as sa

class MasteryRecordHistoryController:
    @classmethod
    def createMasteryRecordHistory(cls, mastery_record_id: int, previous_mastery: float, new_mastery: float, session):
        mastery_record_history = MasteryRecordHistory(
            mastery_record_id=mastery_record_id,
            previous_mastery=previous_mastery,
            new_mastery=new_mastery,
            created_at=datetime.now(timezone.utc),
            updated_at=datetime.now(timezone.utc)
        )
        session.add(mastery_record_history)
        return MasteryRecordHistorySchema.from_orm(mastery_record_history)

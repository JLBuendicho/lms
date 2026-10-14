<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasteryRecordHistory extends Model
{
    public function masteryRecord()
    {
        return $this->belongsTo(MasteryRecords::class);
    }
}

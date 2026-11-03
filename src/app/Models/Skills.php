<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $fillable = [
        'name',
        'topic_id',
    ];

    public function topic()
    {
        return $this->belongsTo(Topics::class);
    }

    public function masteryRecords()
    {
        return $this->hasMany(MasteryRecords::class, 'skill_id');
    }
}

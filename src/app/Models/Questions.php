<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'grade_lvl_id',
        'subject_id',
        'domain_id',
        'topic_id',
        'skill_id',
        'question',
    ];

    public function gradeLvl()
    {
        return $this->belongsTo(GradeLvls::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }
    public function domain()
    {
        return $this->belongsTo(Domains::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topics::class);
    }
    public function skill()
    {
        return $this->belongsTo(Skills::class);
    }
}

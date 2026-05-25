<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $fillable = [
        'question_id',
        'user_id',
        'skill_id',
        'skill_name',
        'response',
        'correct',
        'order_id',
        'assessment_type',
        'is_validated',
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function skill()
    {
        return $this->belongsTo(Skills::class);
    }
}

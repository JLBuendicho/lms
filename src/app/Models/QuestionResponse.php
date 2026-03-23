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
        'correct',
        'order_id',
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

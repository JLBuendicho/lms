<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DifficultyBanditInteractions extends Model
{
    protected $fillable = [
        'student_id',
        'skill_id',
        'question_id',
        'arm',
        'selection_source',
        'context',
        'previous_mastery',
        'is_correct',
        'new_mastery',
        'reward',
    ];

    public function student() {
        return $this->belongsTo(User::class);
    }

    public function skill() {
        return $this->belongsTo(Skills::class);
    }

    public function question() {
        return $this->belongsTo(Questions::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'context' => 'array',
        ];
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\LogsContext;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class QuestionResponse extends Model
{
    use LogsActivity, LogsContext;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'question_id',
                'user_id',
                'response',
                'correct',
                'assessment_type',
                'is_validated',
            ])
            ->logOnlyDirty()            // only changed attributes on update
            ->dontLogEmptyChanges()
            ->useLogName('Question Responses');
    }

    protected function activityContext(): array
    {
        return [
            'owner'           => $this->user?->name,
            'owner_lrn'       => $this->user?->lrn,
            'question'        => str($this->question?->question)->limit(150)->toString(),
            'skill'           => $this->skill_name,
            'assessment_type' => $this->assessment_type,
            'response'        => $this->response,
            'order'           => $this->order_id,
        ];
    }

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

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'response' => 'array',
        ];
    }
}

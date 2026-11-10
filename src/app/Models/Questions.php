<?php

namespace App\Models;

use App\Models\Concerns\LogsContext;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Questions extends Model
{
    use LogsActivity, LogsContext;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()                  // or ->logOnly(['title', 'status'])
            ->logOnlyDirty()            // only changed attributes on update
            ->dontLogEmptyChanges()
            ->useLogName('Questions');
    }

    protected function activityContext(): array
    {
        return [
            'question'        => str($this->question)->limit(150)->toString(),
            'type'            => $this->question_type,
            'assessment_type' => $this->assessment_type,
            'grade'           => $this->gradeLvl?->name,
            'subject'         => $this->subject?->name,
            'domain'          => $this->domain?->name,
            'topic'           => $this->topic?->name,
            'skill'           => $this->skill?->name,
        ];
    }

    protected $fillable = [
        'is_active',
        'grade_lvl_id',
        'subject_id',
        'domain_id',
        'topic_id',
        'skill_id',
        'question_type',
        'question',
        'choices',
        'answers',
        'attachments',
        'attachment_file_names',
        'assessment_type',
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

    public function questionResponses()
    {
        return $this->hasMany(QuestionResponse::class, 'question_id');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'choices' => 'array',
            'answers' => 'array',
            'attachments' => 'array',
            'attachment_file_names' => 'array',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    protected $fillable = [
        'grade_lvl_id',
        'subject_id',
        'domain_id',
        'topic_id',
        'skill_id',
        'title',
        'content',
        'content_audio_visual_path',
        'attachments',
        'attachment_file_names',
    ];

    /**
     * Relationships
     */
    public function gradeLvl()
    {
        return $this->belongsTo(GradeLvls::class, 'grade_lvl_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject_id');
    }

    public function domain()
    {
        return $this->belongsTo(Domains::class, 'domain_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topics::class, 'topic_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skill_id');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'content' => 'array',
            'attachments' => 'array',
            'attachment_file_names' => 'array',
        ];
    }
}

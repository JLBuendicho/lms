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
}

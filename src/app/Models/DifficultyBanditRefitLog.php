<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DifficultyBanditRefitLog extends Model
{
    protected $fillable = [
        'status',
        'error',
        'interaction_count',
        'started_at',
        'finished_at',
    ];
}

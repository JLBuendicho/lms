<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BktTrainingLog extends Model
{
    protected $fillable = [
        'status',
        'error',
        'response_count',
        'started_at',
        'finished_at',
    ];
}

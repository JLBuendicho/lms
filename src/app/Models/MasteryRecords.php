<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasteryRecords extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}

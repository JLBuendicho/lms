<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeLvls extends Model
{
    protected $fillable = [
        'grade_lvl',
    ];

    public function domains()
    {
        return $this->belongsToMany(Domains::class);
    }
}

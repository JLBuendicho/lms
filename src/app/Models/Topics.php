<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $fillable = [
        'name',
        'domain_id',
    ];

    public function domain()
    {
        return $this->belongsTo(Domains::class);
    }
    public function skills()
    {
        return $this->hasMany(Skills::class);
    }
}

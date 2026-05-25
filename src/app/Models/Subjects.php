<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'name',
    ];

    public function domains()
    {
        return $this->hasMany(Domains::class, 'subject_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

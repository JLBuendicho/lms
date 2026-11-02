<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    public const COLORS = [
        'red'   => 'rgb(255, 99, 132)',
        'emerald' => 'rgb(16, 185, 129)',
        'blue'  => 'rgb(59, 130, 246)',
        'amber' => 'rgb(251, 191, 36)',
        'violet' => 'rgb(139, 92, 246)',
        'default' => 'rgb(107, 114, 128)',
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

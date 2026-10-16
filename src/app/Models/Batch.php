<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'batch',
        'is_active',
    ];

    public function students()
    {
        return $this->hasMany(User::class, 'batch_id', 'id');
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

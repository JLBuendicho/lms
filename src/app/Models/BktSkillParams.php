<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BktSkillParams extends Model
{
    public function skill() {
        return $this->belongsTo(Skills::class, 'skill_id');
    }
}

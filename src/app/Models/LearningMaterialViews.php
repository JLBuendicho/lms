<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterialViews extends Model
{
    protected $fillable = [
        'learning_material_id',
        'student_user_id',
        'viewed_at'
    ];

    /**
     * Relationships
     */
    public function learningMaterials()
    {
        return $this->belongsToMany(LearningMaterial::class, 'learning_material_id');
    }

    public function studentUsers()
    {
        return $this->belongsToMany(User::class, 'student_user_id');
    }
}

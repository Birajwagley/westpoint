<?php

namespace App\Models;

use App\Models\BaseModel;


class Classes extends BaseModel
{
    protected $table = 'classes';
    protected $fillable = [
        'name_en',
        'name_np',
        'icon',
        'description_en',
        'description_np',
        'display_order',
        'is_published',
        'is_admission_allowed'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_admission_allowed' => 'boolean'
    ];

    public function academicLevels()
    {
        return $this->belongsToMany(AcademicLevel::class, 'academic_level_class', 'class_id', 'academic_level_id');
    }
}

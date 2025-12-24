<?php

namespace App\Models;

use App\Models\BaseModel;

class AcademicLevel extends BaseModel
{
    protected $table = 'academic_levels';
    protected $fillable = [
        'slug',
        'name_en',
        'name_np',
        'icon',
        'thumbnail_image',
        'images',
        'tagline_en',
        'tagline_np',
        'short_description_en',
        'short_description_np',
        'description_en',
        'description_np',
        'display_order',
        'is_featured',
        'is_published'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'academic_level_class', 'academic_level_id', 'class_id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'academic_level_id');
    }
}

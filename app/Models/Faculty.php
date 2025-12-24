<?php

namespace App\Models;

use App\Models\BaseModel;

class Faculty extends BaseModel
{
    protected $table = 'faculties';
    protected $fillable = [
        'name_en',
        'name_np',
        'thumbnail_image',
        'images',
        'short_description_en',
        'short_description_np',
        'description_en',
        'description_np',
        'is_featured',
        'is_published',
        'display_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function groupSubjectFaculties()
    {
        return $this->hasMany(FacultyGroupSubject::class);
    }
}

<?php

namespace App\Models;

use App\Models\BaseModel;

class Publication extends BaseModel
{
    protected $table = 'publications';
    protected $fillable = [
        'publication_category_id',
        'published_date',
        'author',
        'name_en',
        'name_np',
        'slug',
        'thumbnail_image',
        'images',
        'short_description_en',
        'short_description_np',
        'description_en',
        'description_np',
        'external_link',
        'is_published',
        'is_featured'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function publicationCategory()
    {
        return $this->belongsTo(PublicationCategory::class, 'publication_category_id', 'id');
    }
}

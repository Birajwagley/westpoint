<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Publication;

class PublicationCategory extends BaseModel
{
    protected $table = 'publication_categories';
    protected $fillable = [
        'name_en',
        'name_np',
        'display_order',
        'is_published',
        'is_featured',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class, 'publication_category_id');
    }
}

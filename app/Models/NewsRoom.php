<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Types;
use App\Models\BaseModel;

class NewsRoom extends BaseModel
{
    protected $table = 'news_rooms';
    protected $fillable = [
        'name_en',
        'name_np',
        'slug',
        'type_id',
        'thumbnail_image',
        'description_en',
        'description_np',
        'images',
        'files',
        'published_date',
        'external_link',
        'display_order',
        'is_published',
        'is_featured',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_room_tag', 'news_room_id', 'tag_id');
    }

    public function type()
    {
        return $this->belongsTo(Types::class, 'type_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\BaseModel;


class Download extends BaseModel
{
    protected $table = 'downloads';
    protected $fillable = [
        'download_category_id',
        'name_en',
        'name_np',
        'file',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function downloadCategory()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id', 'id');
    }
}

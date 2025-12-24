<?php

namespace App\Models;

use App\Models\Download;
use App\Models\BaseModel;

class DownloadCategory extends BaseModel
{
    protected $table = 'download_categories';
    protected $fillable = [
        'name_en',
        'name_np',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}

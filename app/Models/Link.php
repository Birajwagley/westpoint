<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Link extends BaseModel
{
    protected $table = 'links';
    protected $fillable = [
        'name_en',
        'name_np',
        'type',
        'menu_id',
        'url',
        'display_order',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}

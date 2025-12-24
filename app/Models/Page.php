<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Page extends BaseModel
{
    protected $table = 'pages';
    protected $fillable = [
        'menu_id',
        'title_en',
        'title_np',
        'short_description_en',
        'short_description_np',
        'description_en',
        'description_np',
        'banner_image',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}

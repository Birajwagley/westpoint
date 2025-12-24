<?php

namespace App\Models;

use App\Models\BaseModel;

class DrawerNavigation extends BaseModel
{
    protected $table = 'drawer_navigations';
    protected $fillable = [
        'name_en',
        'name_np',
        'icon',
        'type',
        'menu_id',
        'value',
        'display_order',
        'is_published'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}

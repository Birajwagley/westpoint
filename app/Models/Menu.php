<?php

namespace App\Models;

use App\Models\Page;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends BaseModel
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = [
        'type',
        'slug',
        'external_link',
        'parent_id',
        'name_en',
        'name_np',
        'is_featured_navigation',
        'icon',
        'display_order',
        'is_published'
    ];

    protected $casts = [
        'is_featured_navigation' => 'boolean',
        'is_published' => 'boolean',
    ];

    // relations
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('parent');
    }

    public function page()
    {
        return $this->hasOne(Page::class, 'menu_id');
    }
}

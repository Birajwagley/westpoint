<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    protected $appends = ['name', 'title'];

    // scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDisplayOrder($query)
    {
        return $query->orderBy('display_order');
    }

    public function scopeDisplayOrderDesc($query)
    {
        return $query->orderBy('display_order', 'DESC');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrderById($query)
    {
        return $query->orderBy('id', 'ASC');
    }

    public function scopeOrderByIdDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function getNameAttribute()
    {
        return $this->name_en . '<br>' . $this->name_np;
    }

    public function getTitleAttribute()
    {
        return $this->title_en . '<br>' . $this->title_np;
    }
}

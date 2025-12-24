<?php

namespace App\Models;

use App\Models\Faq;
use App\Models\BaseModel;

class FaqCategory extends BaseModel
{
    protected $table = 'faq_categories';
    protected $fillable = [
        'name_en',
        'name_np',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}

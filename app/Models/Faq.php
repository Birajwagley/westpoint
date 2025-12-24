<?php

namespace App\Models;

use App\Models\BaseModel;


class Faq extends BaseModel
{
    protected $table = 'faqs';
    protected $fillable = [
        'faq_category_id',
        'question_en',
        'question_np',
        'answer_en',
        'answer_np',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function faqCategory()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id', 'id');
    }
}

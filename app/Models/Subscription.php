<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends BaseModel
{
    protected $table = 'subscriptions';
    protected $fillable = ['email', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}

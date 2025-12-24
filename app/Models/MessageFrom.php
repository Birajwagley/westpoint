<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageFrom extends Model
{
    protected $table = 'message_from';
    protected $fillable = [
        'slug',
        'image',
        'information_en',
        'information_np'
    ];
}

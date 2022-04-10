<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHasTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    protected $table = 'post_has_tags';
}

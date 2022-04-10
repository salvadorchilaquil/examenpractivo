<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];

    protected $with = [
         'tags',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_has_tags');
    }
}

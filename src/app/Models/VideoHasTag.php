<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoHasTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'video_id',
    ];
}

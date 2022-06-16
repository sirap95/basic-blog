<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'preview_image',
        'main_image',
        'youtube_link',
        'views'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'post_image', 'post_id', 'image_id');
    }

    public function getImageIdsAttribute()
    {
        return $this->images->pluck('id');
    }
}

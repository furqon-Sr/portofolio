<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'cover_image', 'references'];

    protected $casts = [
        'references' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = \Illuminate\Support\Str::slug($article->title) . '-' . uniqid();
            }
        });
    }
}

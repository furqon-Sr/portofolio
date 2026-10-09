<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'content',
        'cover_image',
        'cover_image_source',
        'cover_image_source_url',
        'references',
    ];

    /**
     * Get resolved SEO title (with fallback to article title).
     */
    public function getSeoTitleAttribute(): string
    {
        return !empty($this->meta_title) ? $this->meta_title : $this->title;
    }

    /**
     * Get resolved SEO description (with fallback to excerpt or content snippet).
     */
    public function getSeoDescriptionAttribute(): string
    {
        if (!empty($this->meta_description)) {
            return $this->meta_description;
        }

        if (!empty($this->excerpt)) {
            return \Illuminate\Support\Str::limit(strip_tags($this->excerpt), 155);
        }

        return \Illuminate\Support\Str::limit(strip_tags($this->content), 155);
    }

    /**
     * Get resolved SEO keywords string.
     */
    public function getSeoKeywordsAttribute(): string
    {
        return $this->meta_keywords ?? '';
    }

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'cover_image',
        'github_link',
        'gallery_assets'
    ];
    protected $casts = [
        'gallery_assets' => 'array',
    ];
}

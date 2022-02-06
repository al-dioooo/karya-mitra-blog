<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'title',
        'subtitle',
        'content',
        'meta_desc'
    ];

    protected $fillable = [
        'author_id',
        'cover',
        'slug',
        'is_published'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}

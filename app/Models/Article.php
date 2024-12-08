<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Article extends Model
{
    use HasFactory, Sluggable, HasTags;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'user_id',
        'image',
        'publish',
        'recommended',
        'views',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    // Local Scope: Filter hanya artikel yang sudah dipublikasikan
    public function scopePublished($query)
    {
        return $query->whereNotNull('publish');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'long_description',
        'tech',
        'images',
        'github',
        'live',
        'category_id',
        'features',
        'challenges',
        'outcome',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'tech' => 'array',
        'images' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    // Accessor to safely get category name
    public function getCategoryNameAttribute()
    {
        return $this->category_id && $this->relationLoaded('category') && $this->category
            ? $this->category->name
            : 'Uncategorized';
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        if ($categoryId && $categoryId !== 'All') {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereJsonContains('tech', $search);
            });
        }
        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title_fr', 'title_en',
        'slug',
        'excerpt_fr', 'excerpt_en',
        'content_fr', 'content_en',
        'category',
        'author_name',
        'is_published',
        'published_at',
        'meta_description_fr', 'meta_description_en',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    const CATEGORIES = [
        'actualite'   => 'Actualité',
        'sante'       => 'Santé',
        'education'   => 'Éducation',
        'terrain'     => 'Actions terrain',
        'partenariat' => 'Partenariat',
        'rapport'     => 'Rapport',
    ];

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title_fr ?? $post->title_en ?? 'post');
            }
        });
    }

    public function getTitle(): string
    {
        return app()->getLocale() === 'fr'
            ? $this->title_fr
            : ($this->title_en ?? $this->title_fr);
    }

    public function getExcerpt(): string
    {
        $excerpt = app()->getLocale() === 'fr'
            ? $this->excerpt_fr
            : ($this->excerpt_en ?? $this->excerpt_fr);

        if ($excerpt) {
            return $excerpt;
        }

        // Auto-generate from content
        $content = $this->getContent();
        return Str::limit(strip_tags($content), 180);
    }

    public function getContent(): string
    {
        return app()->getLocale() === 'fr'
            ? ($this->content_fr ?? '')
            : ($this->content_en ?? $this->content_fr ?? '');
    }

    public function getMetaDescription(): string
    {
        $meta = app()->getLocale() === 'fr'
            ? $this->meta_description_fr
            : ($this->meta_description_en ?? $this->meta_description_fr);

        return $meta ?? $this->getExcerpt();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)->height(360)->format('webp');
        $this->addMediaConversion('hero')
            ->width(1200)->height(630)->format('webp');
        $this->addMediaConversion('card')
            ->width(800)->height(450)->format('webp');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function getReadingTime(): int
    {
        $words = str_word_count(strip_tags($this->content_fr ?? ''));
        return max(1, (int) ceil($words / 200));
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Action extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title_fr','title_en','description_fr','description_en','category','date','is_active','slug'];
    protected $casts = ['date' => 'date', 'is_active' => 'boolean'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('cover')->singleFile();
    }
    public function registerMediaConversions(?Media $media = null): void {
        $this->addMediaConversion('thumb')->width(600)->height(400)->format('webp');
    }
    public function getTitle(): string { return app()->getLocale() === 'fr' ? $this->title_fr : ($this->title_en ?? $this->title_fr); }
    public function getDescription(): string { return app()->getLocale() === 'fr' ? $this->description_fr : ($this->description_en ?? $this->description_fr); }
    public function scopeActive($query) { return $query->where('is_active', true); }
}

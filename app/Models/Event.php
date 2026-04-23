<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title_fr','title_en','description_fr','description_en','date','location','status','is_active','slug'];
    protected $casts = ['date' => 'datetime', 'is_active' => 'boolean'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('cover')->singleFile();
    }
    public function registerMediaConversions(?Media $media = null): void {
        $this->addMediaConversion('thumb')->width(400)->height(300)->format('webp');
        $this->addMediaConversion('hero')->width(1200)->height(630)->format('webp');
    }
    public function isUpcoming(): bool { return $this->date > now(); }
    public function getTitle(): string { return app()->getLocale() === 'fr' ? $this->title_fr : ($this->title_en ?? $this->title_fr); }
    public function getDescription(): string { return app()->getLocale() === 'fr' ? $this->description_fr : ($this->description_en ?? $this->description_fr); }
    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeUpcoming($query) { return $query->where('date', '>', now())->orderBy('date'); }
    public function scopePast($query) { return $query->where('date', '<=', now())->orderByDesc('date'); }
}

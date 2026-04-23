<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Testimonial extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['name','role','text_fr','text_en','is_active','order'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('photo')->singleFile();
    }
    public function registerMediaConversions(?Media $media = null): void {
        $this->addMediaConversion('thumb')->width(120)->height(120)->format('webp');
    }
    public function getText(): string { return app()->getLocale() === 'fr' ? $this->text_fr : ($this->text_en ?? $this->text_fr); }
    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
}

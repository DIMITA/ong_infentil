<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title','category','year','visibility','tags','description'];
    protected $casts = ['tags' => 'array', 'year' => 'integer'];
    const CATEGORIES = ['rapport_annuel','bilan','communique','presentation','autre'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('file')->singleFile();
    }
    public function isPublic(): bool { return $this->visibility === 'public'; }
    public function scopePublic($query) { return $query->where('visibility', 'public'); }
    public function scopeByYear($query, $year) { return $query->where('year', $year); }
    public function scopeByCategory($query, $cat) { return $query->where('category', $cat); }
}

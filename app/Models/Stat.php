<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stat extends Model {
    use HasFactory;
    protected $fillable = ['key','value','label_fr','label_en','icon','order'];
    protected $casts = ['value' => 'integer', 'order' => 'integer'];
    public function getLabel(): string { return app()->getLocale() === 'fr' ? $this->label_fr : ($this->label_en ?? $this->label_fr); }
    public function scopeOrdered($query) { return $query->orderBy('order'); }
}

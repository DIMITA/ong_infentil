<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model {
    use HasFactory;
    protected $fillable = ['name','email','token','confirmed_at','unsubscribed_at'];
    protected $casts = ['confirmed_at' => 'datetime', 'unsubscribed_at' => 'datetime'];

    public function isConfirmed(): bool { return !is_null($this->confirmed_at); }
    public function isUnsubscribed(): bool { return !is_null($this->unsubscribed_at); }
    public function scopeActive($query) { return $query->whereNotNull('confirmed_at')->whereNull('unsubscribed_at'); }
}

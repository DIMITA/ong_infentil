<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model {
    use HasFactory;
    protected $fillable = ['reference','amount','currency','donor_name','donor_email','donor_phone','status','payment_method','transaction_id','raw_payload'];
    protected $casts = ['amount' => 'decimal:2', 'raw_payload' => 'array'];
    const STATUSES = ['pending','completed','failed','refunded'];
    public function scopeCompleted($query) { return $query->where('status', 'completed'); }
}

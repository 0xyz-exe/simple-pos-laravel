<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_code', 'user_id', 'subtotal', 'tax', 'discount', 'total'];
    protected $casts = ['subtotal' => 'decimal:2', 'tax' => 'decimal:2', 'discount' => 'decimal:2', 'total' => 'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(TransactionItem::class); }
    public static function generateCode() { return 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6)); }
}

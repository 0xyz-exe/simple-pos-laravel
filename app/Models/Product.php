<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'sku', 'description', 'price', 'stock'];
    protected $casts = ['price' => 'decimal:2'];
    public function category() { return $this->belongsTo(Category::class); }
    public function scopeLowStock($query, $threshold = 10) { return $query->where('stock', '<=', $threshold); }
}

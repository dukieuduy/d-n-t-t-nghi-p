<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_sku',
        'quantity',
    ];
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Mối quan hệ với Product (nếu có)
    // Model OrderItem
// Model OrderItem
    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_sku', 'sku'); // product_sku liên kết với sku trong product_variations
    }






}

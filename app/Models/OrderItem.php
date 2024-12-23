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
    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_sku', 'sku');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'sku', 'price', 'stock_quantity', 'image',
    ];

   // Mối quan hệ với Product (biến thể thuộc về một sản phẩm)
// Model ProductVariation
public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}



    // Mối quan hệ với ProductVariationAttribute (một biến thể có thể có nhiều thuộc tính)
    public function variationAttributes()
    {
        return $this->hasMany(ProductVariationAttribute::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [        
    'cart_id',
    'product_sku',
    'product_id',
    'size',
    'color',
    'quantity',
    'price',
    'product_name',
    'image',
    'product_variation_id'];

    // Mối quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function variant()
    {
        return $this->hasOne(ProductVariation::class);
    }

    /**
     * Quan hệ với sản phẩm (Product) nếu cần.
     */
}

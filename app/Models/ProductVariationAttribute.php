<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variation_id',
        'product_attribute_value_id',
        'product_attribute_id'
    ];

    // Mối quan hệ với ProductVariation (biến thể thuộc về một biến thể sản phẩm)
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    // Mối quan hệ với ProductAttributeValue (giá trị thuộc tính)
    public function attributeValue()
    {
        return $this->belongsTo(ProductAttributeValue::class, 'product_attribute_value_id');
    }
    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }
}

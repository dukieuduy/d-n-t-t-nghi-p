<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'province_id', 'code', 'type'];  // Các trường trong bảng 'districts'

    // Mối quan hệ với Province (mỗi quận huyện thuộc một tỉnh thành)
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Mối quan hệ với Ward (một quận huyện có nhiều phường xã)
    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_id');
    }
    public function shippingFees()
    {
        return $this->hasMany(ShippingFee::class);
    }
}

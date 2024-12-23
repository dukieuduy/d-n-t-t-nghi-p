<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'code', 'type'];  // Các trường trong bảng 'provinces'

    // Mối quan hệ với District (một tỉnh thành có nhiều quận huyện)
    public function districts()
    {
        return $this->hasMany(District::class, 'province_id');
    }

    // Mối quan hệ với Ward (tỉnh thành có thể có nhiều phường xã thông qua District)
    public function wards()
    {
        return $this->hasManyThrough(Ward::class, District::class);
    }
}

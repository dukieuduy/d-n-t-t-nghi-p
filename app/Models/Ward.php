<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'district_id', 'code', 'type'];  // Các trường trong bảng 'wards'

    // Mối quan hệ với District (mỗi phường xã thuộc một quận huyện)
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Mối quan hệ với Province (phường xã có thể có tỉnh thành thông qua District)
    public function province()
    {
        return $this->belongsToThrough(Province::class, District::class);
    }
}

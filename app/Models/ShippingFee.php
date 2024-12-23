<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id', // tên thành phố/tỉnh
        'district_id', // Tên quận/huyện
        'fee', // Phí ship
        'is_free', // Miễn phí ship
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

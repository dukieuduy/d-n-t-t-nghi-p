<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBuyer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_number', 'order_id'];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

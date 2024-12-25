<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'value',
        'type',
        'start_date',
        'end_date',
        'min_purchase_amount',
        'max_purchase_amount',
        'quantity',
        'is_active',
    ];
}

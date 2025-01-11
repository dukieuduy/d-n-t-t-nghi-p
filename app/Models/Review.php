<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'is_active',
        'comment_parent',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Quan hệ admin (admin trả lời bình luận)
    public function replies(){
        return $this->hasMany(Review::class, 'comment_parent');
    }

    // Quan hệ bình luận cha
    public function parent(){
        return $this->belongsTo(Review::class, 'comment_parent');
    }
}

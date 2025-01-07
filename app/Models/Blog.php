<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
     /**
     * Bảng trong cơ sở dữ liệu tương ứng với model này.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * Các cột có thể được gán giá trị thông qua phương thức `create()` hoặc `update()`.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
    ];

    /**
     * Các cột sẽ được ẩn khi trả về JSON (nếu cần).
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Các kiểu dữ liệu của cột.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

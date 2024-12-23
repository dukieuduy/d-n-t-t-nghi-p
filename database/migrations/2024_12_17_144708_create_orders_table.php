<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Liên kết với bảng users
            $table->dateTime('order_date');
            $table->decimal('total_amount', 10, 2); // Tổng số tiền đơn hàng
            $table->enum('status', ['pending', 'completed', 'cancelled', 'paid'])->default('pending'); // Sử dụng enum để quản lý trạng thái
            $table->string('address'); //địa chỉ(thôn, xóm, tổ dân phố)
            $table->string('city');
            $table->string('district');
            $table->string('ward');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

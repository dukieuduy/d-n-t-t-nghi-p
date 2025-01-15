<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guest_buyers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người mua
            $table->string('phone_number'); // Số điện thoại người mua
            $table->unsignedBigInteger('order_id'); // Khóa ngoại đến bảng orders
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_buyers');
    }
};

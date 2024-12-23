<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingFeesTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id'); // Lưu district_id mà không có foreign key
            $table->decimal('fee', 10, 2)->nullable(); // Phí giao hàng, có thể là null nếu miễn phí
            $table->boolean('is_free')->default(false); // Miễn phí vận chuyển nếu là true
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_fees');
    }
}

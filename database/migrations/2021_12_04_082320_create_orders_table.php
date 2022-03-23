<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_user_id');
            $table->integer('order_order_status_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 10);
            $table->string('address');
            $table->string('coupon_code', 50)->nullable();
            $table->integer('coupon_value')->nullable();
            $table->enum('payment_type', ['COD', 'Gateway']);;
            $table->string('payment_status', 50);
            $table->integer('total_amt');
            $table->text('track_details')->nullable();
            $table->dateTime('added_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

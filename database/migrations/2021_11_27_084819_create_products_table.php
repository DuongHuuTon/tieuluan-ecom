<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id');
            $table->integer('product_tax_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('publisher');
            $table->string('image');
            $table->longText('printing_info')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('warranty')->nullable();
            $table->longText('desc')->nullable();
            $table->string('endow')->nullable();
            $table->integer('is_promo');
            $table->integer('is_featured');
            $table->integer('is_discounted');
            $table->integer('is_trending');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}

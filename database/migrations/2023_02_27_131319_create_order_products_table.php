<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable()->unsigned();
            $table->unsignedBigInteger('product_id')->nullable()->unsigned();
            $table->integer('quantity')->default(1);
            $table->decimal('price',10,2);
            $table->timestamps();
        });

        Schema::table('order_products', function($table) {
            $table->foreign('order_id')->references('id')->on('orders')->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}

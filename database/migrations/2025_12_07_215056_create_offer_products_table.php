<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('offer_id')->nullable()->unsigned();
            $table->unsignedBigInteger('product_id')->nullable()->unsigned();

            $table->decimal('price');

            $table->timestamps();
        });

        Schema::table('offer_products', function($table) {
            $table->foreign('offer_id')->references('id')->on('offers')->nullOnDelete();
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
        Schema::dropIfExists('offer_products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

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

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('customer_id')->unsigned()->nullable();

            $table->enum('confiramtion_status',[Order::PENDING,Order::CONFIRMED,Order::CANCELLED,Order::ON_HOLD])
                  ->default(Order::PENDING);

            $table->enum('delivery_status',[Order::PENDING,Order::IN_TRANSIT,Order::DELIVERED,Order::RETURNED])
                  ->default(Order::PENDING);

            $table->enum('currency',['MAD','USD'])->default('MAD');

            $table->string('address')->nullable();

            $table->string('user_notes',255)->nullable();

            $table->timestamps();
        });
        Schema::table('orders', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
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

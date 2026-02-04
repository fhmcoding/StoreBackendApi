<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('payment_id')->unsigned()->nullable();

            $table->string('status');

            $table->timestamps();
        });

         Schema::table('payment_status_histories', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('payment_id')->references('id')->on('payments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_status_histories');
    }
}

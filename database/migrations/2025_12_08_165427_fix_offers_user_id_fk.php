<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // drop WRONG FK
            $table->dropForeign(['user_id']);

            // add CORRECT FK
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            // rollback to wrong state if needed (optional)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('offers');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id', 'user_id_fk')
                      ->references('id')
                      ->on('users')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');
                $table->float('total');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buys', function (Blueprint $table) {
            
            Schema::dropIfExists('buys');
        });
    }
};

<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('comment');
            $table->tinyInteger('rating');
            $table->foreignId('spot_id', 'spot_id_fk')
                ->references('id')
                ->on('spots')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('user_id', 'user_id_fk')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

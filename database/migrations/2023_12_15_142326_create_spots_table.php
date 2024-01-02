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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->float('price');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id', 'type_id_fk')
                ->references('id')
                ->on('types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->unsignedBigInteger('villager');
            $table->foreign('villager', 'villager_fk')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};

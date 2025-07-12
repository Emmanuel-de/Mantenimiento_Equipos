<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('mantenimientos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
        $table->date('fecha');
        $table->enum('tipo', ['Preventivo', 'Correctivo']);
        $table->text('descripcion');
        $table->text('refacciones')->nullable();
        $table->string('responsable');
        $table->string('evidencia')->nullable(); // Ruta al archivo
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};

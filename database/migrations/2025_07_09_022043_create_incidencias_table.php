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
    Schema::create('incidencias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
        $table->date('fecha');
        $table->text('descripcion');
        $table->string('reportado_por');
        $table->enum('estado', ['Abierta', 'En proceso', 'Cerrada'])->default('Abierta');
        $table->text('solucion')->nullable();
        $table->string('tecnico')->nullable();
        $table->string('evidencia')->nullable(); // archivo o imagen
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};

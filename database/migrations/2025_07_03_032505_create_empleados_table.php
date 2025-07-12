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
    Schema::create('empleados', function (Blueprint $table) {
    $table->id();
    $table->string('nombre_completo');
    $table->string('email')->unique();
    $table->string('telefono');
    $table->string('cargo');
    $table->foreignId('departamento_id')->constrained()->onDelete('cascade');
    $table->string('direccion');
    $table->enum('genero', ['Masculino', 'Femenino']);
    $table->date('fecha_ingreso');
    $table->timestamps();
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};

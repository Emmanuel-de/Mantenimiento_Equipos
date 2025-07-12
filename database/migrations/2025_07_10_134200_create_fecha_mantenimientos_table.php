<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechaMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::create('fecha_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->date('fecha_programada');
            $table->string('responsable');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fecha_mantenimientos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('departamento_id')->constrained()->onDelete('cascade');
            $table->string('responsable');
            $table->string('marca');
            $table->string('modelo');
            $table->enum('tipo_equipo', ['Laptop', 'PC de escritorio']);
            $table->string('memoria_ram');
            $table->string('disco_duro'); // Ej: 500 GB
            $table->enum('tipo_disco', ['SSD', 'HDD']);
            $table->string('procesador');
            $table->string('numero_serie')->unique();
            $table->date('fecha_adquisicion');
            $table->enum('estado', ['Activo', 'Inactivo', 'Mantenimiento']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};


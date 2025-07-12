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
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_mantenimiento_id')->after('fecha');

            // Clave foránea (opcional pero recomendable)
            $table->foreign('tipo_mantenimiento_id')->references('id')->on('tipo_mantenimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Primero eliminar la clave foránea
            $table->dropForeign(['tipo_mantenimiento_id']);
            // Después eliminar la columna
            $table->dropColumn('tipo_mantenimiento_id');
        });
    }
};


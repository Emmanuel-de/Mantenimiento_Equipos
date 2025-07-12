<?php
// database/migrations/xxxx_xx_xx_create_tipo_mantenimientos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_mantenimientos');
    }
}

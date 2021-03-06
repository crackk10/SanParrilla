<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCliente',20);
            $table->string('apellidoCliente', 20)->nullable();
            $table->string('telefonoCliente',15)->nullable();
            $table->string('direccion',30)->nullable();
            $table->string('barrio',30)->nullable();
            $table->string('documento',15)->nullable();
            $table->string('indicacion', 200)->nullable();
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
};

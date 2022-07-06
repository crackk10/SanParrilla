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
        Schema::create('domiciliario', function (Blueprint $table) {
            $table->id();
            $table->string('documentoDomiciliario',15);
            $table->string('nombreDomiciliario',20);
            $table->string('apellidoDomiciliario', 20);
            $table->string('fotoSeguridad')->nullable($value='true');
            $table->string('telefonoDomiciliario',15);
            $table->unsignedBigInteger('estadoDomiciliario');
            $table->foreign('estadoDomiciliario','fk_estado_domiciliario')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('domiciliario');
    }
};

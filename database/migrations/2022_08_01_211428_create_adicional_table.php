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
        Schema::create('adicional', function (Blueprint $table) {
            $table->id();
            $table->string('nombreAdicional', 30);
            $table->bigInteger('precioAdicional');
            $table->string('descripcionAdicional', 200)->nullable();
            $table->unsignedBigInteger('subCategoriaAdicional');
            $table->foreign('subCategoriaAdicional', 'fk_adicional_subCategoria')->references('id')->on('sub_categoria')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('estadoAdicional');
            $table->foreign('estadoAdicional', 'fk_adicional_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');
            $table->string('fotoAdicional')->nullable($value = 'true');
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
        Schema::dropIfExists('adicional');
    }
};

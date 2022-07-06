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
        Schema::create('sub_categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombreSubCategoriaPlato', 30);
            $table->unsignedBigInteger('categoria');
            $table->foreign('categoria','fk_categoria_subCategoria')->references('id')->on('categoria')->onDelete('restrict')->onUpdate('restrict');                   
            $table->unsignedBigInteger('estadoSubCategoria');
            $table->foreign('estadoSubCategoria','fk_estado_estadoSubCategoria')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');                             
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
        Schema::dropIfExists('sub_categoria');
    }
};

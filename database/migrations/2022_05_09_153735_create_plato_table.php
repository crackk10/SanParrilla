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
        Schema::create('plato', function (Blueprint $table) {
            $table->id();
            $table->string('nombrePlato',30);
            $table->bigInteger('precio');
            $table->string('descripcion', 200)->nullable();
            $table->unsignedBigInteger('subCategoriaPlato');
            $table->foreign('subCategoriaPlato','fk_plato_subCategoria')->references('id')->on('sub_categoria')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('estadoPlato');
            $table->foreign('estadoPlato','fk_estado_estadoPlato')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');                  
            $table->string('fotoPlato')->nullable($value='true');
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
        Schema::dropIfExists('plato');
    }
};

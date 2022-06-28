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
            $table->unsignedBigInteger('categoriaPlato');
            $table->foreign('categoriaPlato','fk_plato_categoria')->references('id')->on('categoria')->onDelete('restrict')->onUpdate('restrict');         
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

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
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato');
            $table->foreign('plato','fk_detalle_plato')->references('id')->on('plato')->onDelete('restrict')->onUpdate('restrict');         
            $table->unsignedBigInteger('pedido');
            $table->foreign('pedido','fk_detalle_pedido')->references('id')->on('pedido')->onDelete('restrict')->onUpdate('restrict');         
            $table->integer('cantidad');
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
        Schema::dropIfExists('detalle_pedido');
    }
};

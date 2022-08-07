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
        Schema::create('adicional_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adicional');
            $table->foreign('adicional', 'fk_AdicionalDetalle_adicional')->references('id')->on('adicional')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('detalle');
            $table->foreign('detalle', 'fk_AdicionalDetalle_detalle')->references('id')->on('detalle_pedido')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('adicional_detalle');
    }
};

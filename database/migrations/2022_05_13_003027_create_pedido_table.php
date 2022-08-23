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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario');
            $table->foreign('usuario', 'fk_pedido_usuario')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('cliente');
            $table->foreign('cliente', 'fk_pedido_cliente')->references('id')->on('cliente')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('domiciliario');
            $table->foreign('domiciliario', 'fk_pedido_domiciliario')->references('id')->on('domiciliario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipoPago');
            $table->foreign('tipoPago', 'fk_pedido_tipoPago')->references('id')->on('tipo_pago')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipoPedido');
            $table->foreign('tipoPedido', 'fk_pedido_tipoPedido')->references('id')->on('tipo_pedido')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('estadoPedido');
            $table->foreign('estadoPedido', 'fk_estado_estadoPedido')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');
            $table->string('observacion', 200)->nullable();
            $table->bigInteger('total')->nullable();
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
        Schema::dropIfExists('pedido');
    }
};

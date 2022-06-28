<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoPedido = [
            'mesa',
            'domicilio',
            'credito',
            'contrato',
        ];
        foreach($tipoPedido as $key => $value){
            DB::table('tipo_pedido')->insert([
                'nombreTipoPedido' => $value,
                
            ]);
        }
    }
}

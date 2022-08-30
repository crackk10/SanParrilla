<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class MesaController extends Controller
{
  public function index()
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      return view('admin/editarPedido/mesa/indexMesa');
    } else {
      return back();
    }
  }
  public function listar()
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Pedido::select('pedido.*', 'cliente.nombreCliente', 'cliente.apellidoCliente', 'tipo_pago.nombreTipoPago')
        ->orderBy('created_at', 'asc')
        ->from('pedido')
        ->join('cliente', 'cliente.id', '=', 'pedido.cliente')
        ->join('tipo_pago', 'tipo_pago.id', '=', 'pedido.tipoPago')
        ->where([
          ["tipoPedido", '=', "1"],
          ["estadoPedido", '!=', "5"],
          ["estadoPedido", '!=', "3"]
        ])
        ->paginate(10);
      return view('admin/editarPedido/tabla')->with('datos', $datos);
    } else {
      return back();
    }
  }

  public function actualizarEstado(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $Atualizado = DB::table('pedido')
        ->where('pedido.id', $request->idPedido)
        ->update(['estadoPedido' => $request->estadoPedido]);
      if ($Atualizado) {
        return response()->json(['success' => 'true']);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }
}

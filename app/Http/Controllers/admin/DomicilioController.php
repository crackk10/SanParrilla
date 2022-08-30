<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Domiciliario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomicilioController extends Controller
{
    public function index()
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            return view('admin/editarPedido/domicilio/indexDomicilio');
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
                    ["tipoPedido", '=', "2"],
                    ["domiciliario", '=', "1"],
                    ["estadoPedido", '!=', "5"]
                ])
                ->paginate(10);
            return view('admin/editarPedido/domicilio/includes/tablaDomicilio')->with('datos', $datos);
        } else {
            return back();
        }
    }
    public  function datosDomiciliario()
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $domiciliario = Domiciliario::select()
                ->from('domiciliario')
                ->where('domiciliario.estadoDomiciliario', '=', "1")
                ->get();
            return view('admin/editarPedido/domicilio/includes/datosDomiciliario')->with('datos', $domiciliario);
        } else {
            return back();
        }
    }
    public function ActualizarDomiciliario(Request $request)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $Atualizado = DB::table('pedido')
                ->where('id', $request->idPedido)
                ->update(['domiciliario' => $request->idDomiciliario]);
            if ($Atualizado) {
                return response()->json(['success' => 'true']);
            } else {
                return response()->json(['success' => 'false']);
            }
        } else {
            return back();
        }
    }
    public function cancelar(Request $request)
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

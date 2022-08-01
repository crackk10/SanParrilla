<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Session\Session;

session_start();

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\Pedido;
use App\Models\Plato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return view('admin/pedido/index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function show(Pedido $pedido)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function edit(Pedido $pedido)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Pedido $pedido)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function destroy(Pedido $pedido)
  {
    //
  }
  /* llenar tabla de platos  */
  public function buscarPlatos(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->buscar != "") {
        $datos = Plato::select('plato.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
          ->orderBy('created_at', 'desc')
          ->from('plato')
          ->join('estados', 'estados.id', '=', 'plato.estadoPlato')
          ->join('sub_categoria', 'sub_categoria.id', '=', 'plato.subCategoriaPlato')
          ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
          ->where([
            ["nombrePlato", 'LIKE', "$request->buscar%"]
          ])
          ->get();
        if ($request->opcion == "lista") {
          return view('admin/pedido/includes/buscar/pedidoTablaListaBuscar')->with('datos', $datos);
        } else {
          if ($request->opcion == "modal") {
            return view('admin/pedido/includes/platos/pedidoTablaPlato')->with('datos', $datos);
          }
        }
      } else {
        $datos = Plato::select('plato.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
          ->orderBy('created_at', 'desc')
          ->from('plato')
          ->join('estados', 'estados.id', '=', 'plato.estadoPlato')
          ->join('sub_categoria', 'sub_categoria.id', '=', 'plato.subCategoriaPlato')
          ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
          ->get();
        if ($request->opcion == "lista") {
          return view('admin/pedido/includes/buscar/pedidoTablaListaBuscar')->with('datos', $datos);
        } else {
          if ($request->opcion == "modal") {
            return view('admin/pedido/includes/platos/pedidoTablaPlato')->with('datos', $datos);
          }
        }
      }
    } else {
      return back();
    }
  }
  /* llenar tabla de clientes */
  public function cliente(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->filtro != "0" && $request->buscar != "") {
        $datos = cliente::select('cliente.*')
          ->orderBy('created_at', 'desc')
          ->from('cliente')
          ->where([
            ["$request->filtro", 'LIKE', "$request->buscar%"]
          ])
          ->paginate(6);
        return view('admin/pedido/includes/clientes/pedidoTablaClientes')->with('datos', $datos);
      } else {
        $datos = cliente::select('cliente.*')
          ->orderBy('created_at', 'desc')
          ->from('cliente')
          ->paginate(6);
        return view('admin/pedido/includes/clientes/pedidoTablaClientes')->with('datos', $datos);
      }
    } else {
      return back();
    }
  }

  //consulta para rellenar el select de tipoPago en index
  public function tipoPago()
  {
    $tipoPago = DB::table('tipo_pago')->get();
    return response()->json($tipoPago);
  }
  //consulta para rellenar el select de tipoPedido en index
  public function tipoPedido()
  {
    $tipoPedido = DB::table('tipo_pedido')->get();
    return response()->json($tipoPedido);
  }

  public function addPlatoCarrito(Request $request)
  {
    $tamañoArray = $request->all();
    if (sizeof($tamañoArray) != 0) {
      $_SESSION['carrito']['plato'][$request->nombre]['cantidad'] = $request->cantidad;
      $_SESSION['carrito']['plato'][$request->nombre]['precio'] = $request->precio;
    }
    $datos = $_SESSION['carrito'];
    return view('admin/pedido/includes/pedidoTablaCarrito')->with('datos', $datos);
  }
  public function eliminarPlatoCarrito(Request $request)
  {
    unset($_SESSION['carrito']['plato'][$request->nombre]);
    $datos = $_SESSION['carrito'];
    return view('admin/pedido/includes/pedidoTablaCarrito')->with('datos', $datos);
  }
  public function vaciarCarrito(Request $request)
  {
    unset($_SESSION['carrito']);
    $datos = null;
    return view('admin/pedido/includes/pedidoTablaCarrito')->with('datos', $datos);
  }
}

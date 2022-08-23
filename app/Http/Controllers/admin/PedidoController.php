<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Session\Session;

session_start();

use App\Http\Controllers\Controller;
use App\Http\Requests\PedidoRequest;
use App\Models\Adicional_detalle;
use App\Models\cliente;
use App\Models\Detalle_pedido;
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
  public function store(PedidoRequest $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->ajax()) {
        /* Guardo el pedido */
        $pedido = new Pedido();
        $pedido->usuario = $request->usuario;
        $pedido->cliente = $request->cliente;
        $pedido->domiciliario = $request->domiciliario;
        $pedido->tipoPago = $request->tipoPago;
        $pedido->tipoPedido = $request->tipoPedido;
        $pedido->estadoPedido = $request->estadoPedido;
        $pedido->observacion = $request->observacion;
        $pedido->total = $request->total;
        $pedido->save();
        /* Guardo los productos del carrito en la tabla detalle */
        $idPedido = DB::table('pedido')->select('id')->latest()->first();
        foreach ($_SESSION['carrito']['plato'] as $nombreplato => $valoresPlato) {
          $detalle_pedido = new Detalle_pedido();
          $detalle_pedido->plato = $valoresPlato['id'];
          $detalle_pedido->pedido = $idPedido->id;
          $detalle_pedido->cantidad = $valoresPlato['cantidad'];
          $detalle_pedido->save();
          foreach ($valoresPlato as $clave => $valor) {
            if ($clave == "adicionales") {
              /* guardo los adicionales en la tabla adicional_detalle */
              $idDetallePedido = DB::table('detalle_pedido')->select('id')->latest()->first();
              foreach ($valor as $arrayAdicional => $adicional) {
                $adicional_detalle = new Adicional_detalle();
                $adicional_detalle->adicional = $adicional['idAdicional'];
                $adicional_detalle->detalle = $idDetallePedido->id;
                $adicional_detalle->cantidad = 1;
                $adicional_detalle->save();
              }
            }
          }
        }

        if ($pedido->save()) {
          return response()->json(['success' => 'true']);
        } else {
          return response()->json(['success' => 'false']);
        }
      } else {
        return back();
      }
    } else {
      return back();
    }
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
        /* Agrego adicionales a los datos del plato */
        $adicional = DB::table('adicional')->get();
        $arrayPlatos = json_decode($datos, true);
        $arrayAdicionales = json_decode($adicional, true);
        for ($p = 0; $p < count($arrayPlatos); $p++) {
          /* para cada plato se va a recorrer todos los adicionales */
          for ($a = 0; $a < count($arrayAdicionales); $a++) {
            /* a cada plato le agrego los adicionales que concuerden en subCategoria */
            if ($arrayPlatos[$p]['subCategoriaPlato'] == $arrayAdicionales[$a]['subCategoriaAdicional']) {
              /* si ya hay adicionales solo agrego el nuevo dato */
              if (isset($arrayPlatos[$p]['adicionales'])) {
                array_push($arrayPlatos[$p]['adicionales'], $arrayAdicionales[$a]);
              } else {
                /* sino, agregego el array adicionalesn al array de platos */
                $arrayAdd = array("adicionales" => array($arrayAdicionales[$a]));
                $arrayPlatos[$p] += $arrayAdd;
              }
            }
          }
        }
        $miObjeto = json_decode(json_encode($arrayPlatos)); //convierto el array en un objeto
        if ($request->opcion == "lista") {
          return view('admin/pedido/includes/buscar/pedidoTablaListaBuscar')->with('datos', $miObjeto);
        } else {
          if ($request->opcion == "modal") {
            return view('admin/pedido/includes/platos/pedidoTablaPlato')->with('datos', $miObjeto);
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
        /* Agrego adicionales a los datos del plato */
        $adicional = DB::table('adicional')->get();
        $arrayPlatos = json_decode($datos, true);
        $arrayAdicionales = json_decode($adicional, true);
        for ($p = 0; $p < count($arrayPlatos); $p++) {
          /* para cada plato se va a recorrer todos los adicionales */
          for ($a = 0; $a < count($arrayAdicionales); $a++) {
            /* a cada plato le agrego los adicionales que concuerden en subCategoria */
            if ($arrayPlatos[$p]['subCategoriaPlato'] == $arrayAdicionales[$a]['subCategoriaAdicional']) {
              /* si ya hay adicionales solo agrego el nuevo dato */
              if (isset($arrayPlatos[$p]['adicionales'])) {
                array_push($arrayPlatos[$p]['adicionales'], $arrayAdicionales[$a]);
              } else {
                /* sino, agregego la session del array adicionales */
                $arrayAdd = array("adicionales" => array($arrayAdicionales[$a]));
                $arrayPlatos[$p] += $arrayAdd;
              }
            }
          }
        }
        $miObjeto = json_decode(json_encode($arrayPlatos)); //convierto el array en un objeto
        if ($request->opcion == "lista") {
          return view('admin/pedido/includes/buscar/pedidoTablaListaBuscar')->with('datos', $miObjeto);
        } else {
          if ($request->opcion == "modal") {
            return view('admin/pedido/includes/platos/pedidoTablaPlato')->with('datos', $miObjeto);
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
}

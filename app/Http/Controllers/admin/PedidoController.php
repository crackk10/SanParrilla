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

  public function addPlatoCarrito(Request $request)
  {
    $tamañoArray = $request->all();
    if (sizeof($tamañoArray) != 0) { /* si el formulario no esta vacio agrego valores a la session*/
      if (
        isset($_SESSION['carrito']['plato'][$request->nombre . "(0)"]['cantidad'])
        && $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['cantidad'] > 0
        && isset($tamañoArray['adicionales']) == false
      ) {
        /* si ya existe el plato en carrito y su cantidad es mayor a 0 y no trae adicionales */
        $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['cantidad'] += $request->cantidad;
      } else {
        if (isset($tamañoArray['adicionales']) == false) {
          /* sino, simplemente agrego el carrito */
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['cantidad'] = $request->cantidad;
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['nombre'] = $request->nombre;
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['precio'] = $request->precio;
        }
      }

      if (isset($tamañoArray['adicionales'])) { /* si tiene adicionales */
        /*funcion para agregar plato a carrito */
        function agregarSession($request, $nuevoNumeroNombre, $tamañoArray)
        {
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['cantidad'] = $request->cantidad;
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['nombre'] = $request->nombre  . "(" . $nuevoNumeroNombre . ")";
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['precio'] = $request->precio;

          for ($i = 0; $i < count($tamañoArray['adicionales']); $i++) {
            /* recorro cada uno de los adicionales y consulto sus datos en la BD*/
            $adicional = DB::table('adicional')->where('id', $tamañoArray['adicionales'][$i])->get();
            if ($adicional) {/* agrego los datos a la session */
              $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['adicionales'][$adicional[0]->nombreAdicional]['nombreAdicional'] = $adicional[0]->nombreAdicional;
              $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['adicionales'][$adicional[0]->nombreAdicional]['precioAdicional'] = $adicional[0]->precioAdicional;
            }
          }
        }
        if (
          isset($_SESSION['carrito']['plato'][$request->nombre . "(0)"]) == false &&
          isset($_SESSION['carrito']['plato'][$request->nombre . "(1)"]) == false
        ) { /* si no se ha creado  la linea 0 o 1 de ese item, creo la 1 */
          $nuevoNumeroNombre = (int)1;
          agregarSession($request, $nuevoNumeroNombre, $tamañoArray);
        } else {
          /* si ya se creo la linea 1 creo la linea 2 */
          // Returns the key at the end of the array
          function endKey($array)
          {
            //Aquí utilizamos end() para poner el puntero
            //en el último elemento, no para devolver su valor
            end($array);
            return key($array);
          }
          $var = $_SESSION['carrito']['plato'];
          $numeroNombre = endKey($var);
          $numeroSuma = (int) substr($numeroNombre, -2, 1);
          $nuevoNumeroNombre = $numeroSuma + 1;
          agregarSession($request, $nuevoNumeroNombre, $tamañoArray);
        }
      }
    }
    /* finalmente retorno la session y la vista
    sí el formulario esta vacio simplemente retorna la session y la vista */
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
  public function eliminarAdicionalCarrito(Request $request)
  {
    unset($_SESSION['carrito']['plato'][$request->nombrePlato]['adicionales'][$request->nombreAdicional]);
    $datos = $_SESSION['carrito'];
    return view('admin/pedido/includes/pedidoTablaCarrito')->with('datos', $datos);
  }
}

<?php

namespace App\Http\Controllers\admin;

session_start();

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{

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
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['id'] = $request->idPlato;
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['cantidad'] = $request->cantidad;
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['nombre'] = $request->nombre;
          $_SESSION['carrito']['plato'][$request->nombre . "(0)"]['precio'] = $request->precio;
        }
      }

      if (isset($tamañoArray['adicionales'])) { /* si tiene adicionales */
        /*funcion para agregar plato a carrito */
        function agregarSession($request, $nuevoNumeroNombre, $tamañoArray)
        {
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['id'] = $request->idPlato;
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['cantidad'] = $request->cantidad;
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['nombre'] = $request->nombre  . "(" . $nuevoNumeroNombre . ")";
          $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['precio'] = $request->precio;

          for ($i = 0; $i < count($tamañoArray['adicionales']); $i++) {
            /* recorro cada uno de los adicionales y consulto sus datos en la BD*/
            $adicional = DB::table('adicional')->where('id', $tamañoArray['adicionales'][$i])->get();
            if ($adicional) {/* agrego los datos a la session */
              $_SESSION['carrito']['plato'][$request->nombre . "(" . $nuevoNumeroNombre . ")"]['adicionales'][$adicional[0]->nombreAdicional]['idAdicional'] = $adicional[0]->id;
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

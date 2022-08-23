<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adicionalRequest;
use App\Models\Adicional;
use Illuminate\Http\Request;
use App\Models\SubCategoria;

class AdicionalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin/adicional/index');
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(adicionalRequest $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $arrayInputs = $request->all();

      if ($request->ajax()) {
        if (isset($arrayInputs['subCategoriaAdicional'])) {
          for ($i = 0; $i < count($arrayInputs['subCategoriaAdicional']); $i++) {
            $adicional = new Adicional();
            $adicional->nombreAdicional = $request->nombreAdicional;
            $adicional->precioAdicional = $request->precioAdicional;
            $adicional->estadoAdicional = $request->estadoAdicional;
            $adicional->subCategoriaAdicional = $arrayInputs['subCategoriaAdicional'][$i];
            $adicional->save();
          }
        }

        if ($adicional->save()) {
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
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Adicional  $adicional
   * @return \Illuminate\Http\Response
   */
  public function edit($adicional)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $detalleAdicional = Adicional::select()
        ->from('adicional')
        ->where('adicional.id', '=', "$adicional")
        ->get();

      if ($detalleAdicional) {
        return response()->json(['success' => 'true', 'data' => $detalleAdicional]);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Adicional  $adicional
   * @return \Illuminate\Http\Response
   */
  public function update(adicionalRequest $request, Adicional $adicional)
  {
    $formulario = $request->all();
    $resultado = $adicional->fill($formulario)->save();
    if ($resultado) {
      return response()->json(['success' => 'true']);
    } else {
      return response()->json(['success' => 'false']);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Adicional  $adicional
   * @return \Illuminate\Http\Response
   */
  public function destroy(Adicional $adicional)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $resultado = $adicional->delete();
      if ($resultado) {
        return response()->json(['success' => 'true']);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  //consulta para rellenar el select de subCategoria en index
  public function subCategoria(SubCategoria $subCategoria)
  {
    $subCategoria = SubCategoria::select('sub_categoria.*', 'categoria.nombreCategoriaPlato')
      ->from('sub_categoria')
      ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
      ->get();
    return response()->json($subCategoria);
  }

  public function listar(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->filtro != "0" && $request->buscar != "") {
        $datos = Adicional::select('adicional.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
          ->orderBy('created_at', 'desc')
          ->from('adicional')
          ->join('estados', 'estados.id', '=', 'adicional.estadoAdicional')
          ->join('sub_categoria', 'sub_categoria.id', '=', 'adicional.subCategoriaAdicional')
          ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
          ->where([
            ["$request->filtro", 'LIKE', "$request->buscar%"]
          ])
          ->paginate(6);
        return view('admin/adicional/includes/tabla')->with('datos', $datos);
      } else {
        $datos = Adicional::select('adicional.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
          ->orderBy('created_at', 'desc')
          ->from('adicional')
          ->join('estados', 'estados.id', '=', 'adicional.estadoAdicional')
          ->join('sub_categoria', 'sub_categoria.id', '=', 'adicional.subCategoriaAdicional')
          ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
          ->paginate(6);

        return view('admin/adicional/includes/tabla')->with('datos', $datos);
      }
    } else {
      return back();
    }
  }
}

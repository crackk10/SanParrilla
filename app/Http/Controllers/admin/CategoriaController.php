<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Adicional;
use App\Models\Categoria;
use App\Models\Plato;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin/categoria/index');
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
    public function store(CategoriaRequest $request)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            if ($request->ajax()) {
                $categoria = new Categoria();
                $categoria->nombreCategoriaPlato = $request->nombreCategoriaPlato;
                $categoria->estadoCategoria = $request->estadoCategoria;
                $categoria->save();
                if ($categoria->save()) {
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
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($categoria)
    {
        //
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $detalleCategoria = Categoria::select()
                ->from('categoria')
                ->where('categoria.id', '=', "$categoria")
                ->get();
            /* return response()->json($detalleCliente);   */
            if ($detalleCategoria) {
                return response()->json(['success' => 'true', 'data' => $detalleCategoria]);
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
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request,  $categoria)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            if ($request->ajax()) {
                /* modifico todas las sub_categorias   */
                SubCategoria::where('categoria', $categoria)
                    ->update(['estadoSubCategoria' => $request->estadoCategoria]);
                /* modifico todos los platos   */
                Plato::join('sub_categoria', 'sub_categoria.id', '=', 'plato.subCategoriaPlato')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')->where('categoria.id', $categoria)
                    ->update(['estadoPlato' => $request->estadoCategoria]);
                /* modifico todos los adicionales   */
                Adicional::join('sub_categoria', 'sub_categoria.id', '=', 'adicional.subCategoriaAdicional')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')->where('categoria.id', $categoria)
                    ->update(['estadoAdicional' => $request->estadoCategoria]);

                /* modifico las categorias */
                $registro = Categoria::findOrFail($categoria);
                $formulario = $request->all();
                $resultado = $registro->fill($formulario)->save();
                if ($resultado) {
                    return response()->json(['success' => 'true']);
                } else {
                    return response()->json(['success' => 'false']);
                }
            }
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoria)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $borrado = Categoria::findOrFail($categoria);
            $resultado = $borrado->delete();
            if ($resultado) {
                return response()->json(['success' => 'true']);
            } else {
                return response()->json(['success' => 'false']);
            }
        } else {
            return back();
        }
    }
    public function listar(Request $request)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            if ($request->filtro != "0" && $request->buscar != "") {
                $datos = Categoria::select('categoria.*', 'estados.nombreEstado')
                    ->orderBy('created_at', 'desc')
                    ->from('categoria')
                    ->join('estados', 'estados.id', '=', 'categoria.estadoCategoria')
                    ->where([
                        ["$request->filtro", 'LIKE', "$request->buscar%"]
                    ])
                    ->paginate(6);
                return view('admin/categoria/includes/tabla')->with('datos', $datos);
            } else {
                $datos = Categoria::select('categoria.*', 'estados.nombreEstado')
                    ->orderBy('created_at', 'desc')
                    ->from('categoria')
                    ->join('estados', 'estados.id', '=', 'categoria.estadoCategoria')
                    ->paginate(6);
                return view('admin/categoria/includes/tabla')->with('datos', $datos);
            }
        } else {
            return back();
        }
    }
}

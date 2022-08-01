<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlatoRequest;
use App\Models\Plato;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PlatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/plato/index');
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
    public function store(PlatoRequest $request)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $nombre = "Sin Foto";
            if ($request->hasFile('fotoPlato')) {
                /* cargar imagenes con plugin para redimencionar imagenes */
                /* al nombre original del archivo le agrego 10 caracteres random */
                $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoPlato')->getClientOriginalName();
                /* selecciono la ruta donde queda guardada la imagen con su nombre */
                $url = storage_path() . '\app\public\imagenes/' . $nombre;

                /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
                Image::make($request->file('fotoPlato'))->resize(300, 200)->save($url);
            }


            if ($request->ajax()) {
                $plato = new Plato();
                $plato->nombrePlato = $request->nombrePlato;
                $plato->precio = $request->precio;
                $plato->descripcion = $request->descripcion;
                $plato->fotoPlato = '/storage/imagenes/' . $nombre; //guardo la url en la bd
                $plato->estadoPlato = $request->estadoPlato;
                $plato->subCategoriaPlato = $request->subCategoriaPlato;
                $plato->save();

                if ($plato->save()) {
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
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function show(Plato $plato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function edit($plato)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $detallePlato = Plato::select()
                ->from('plato')
                ->where('plato.id', '=', "$plato")
                ->get();
            /* decodifico la respuesta para modificar el campo de la foto */
            $array = json_decode($detallePlato, true);
            $array[0]["fotoPlato"] =  asset($array[0]["fotoPlato"]);
            if ($detallePlato) {
                return response()->json(['success' => 'true', 'data' => $array]);
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
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function update(PlatoRequest $request, Plato $plato)
    {
        $formulario = $request->all();
        if ($request->hasFile('fotoPlato')) {
            /* elimino la imagen anterior */
            $url = str_replace('storage', 'public', $plato->fotoPlato);
            Storage::delete($url);
            /* cargar imagenes con plugin para redimencionar imagenes */
            /* al nombre original del archivo le agrego 10 caracteres random */
            $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoPlato')->getClientOriginalName();
            /* selecciono la ruta donde queda guardada la imagen con su nombre */
            $urlNuevo = storage_path() . '\app\public\imagenes/' . $nombre;

            /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
            Image::make($request->file('fotoPlato'))->resize(300, 200)->save($urlNuevo);
            $formulario["fotoPlato"] = '/storage/imagenes/' . $nombre; //guardo la url en la bd
        }

        $resultado = $plato->fill($formulario)->save();

        if ($resultado) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plato $plato)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            /* Elimino archivo del servidor */
            $url = str_replace('storage', 'public', $plato->fotoPlato);
            Storage::delete($url);
            /* Elimino registro de la bd */

            $resultado = $plato->delete();
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
                $datos = Plato::select('plato.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
                    ->orderBy('created_at', 'desc')
                    ->from('plato')
                    ->join('estados', 'estados.id', '=', 'plato.estadoPlato')
                    ->join('sub_categoria', 'sub_categoria.id', '=', 'plato.subCategoriaPlato')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
                    ->where([
                        ["$request->filtro", 'LIKE', "$request->buscar%"]
                    ])
                    ->paginate(6);
                return view('admin/plato/includes/tabla')->with('datos', $datos);
            } else {
                $datos = Plato::select('plato.*', 'estados.nombreEstado', 'sub_categoria.nombreSubCategoriaPlato', 'categoria.nombreCategoriaPlato')
                    ->orderBy('created_at', 'desc')
                    ->from('plato')
                    ->join('estados', 'estados.id', '=', 'plato.estadoPlato')
                    ->join('sub_categoria', 'sub_categoria.id', '=', 'plato.subCategoriaPlato')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria')
                    ->paginate(6);

                return view('admin/plato/includes/tabla')->with('datos', $datos);
            }
        } else {
            return back();
        }
    }
}

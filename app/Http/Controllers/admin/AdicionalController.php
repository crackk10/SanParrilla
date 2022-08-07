<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adicionalRequest;
use App\Models\Adicional;
use Illuminate\Http\Request;
use App\Models\SubCategoria;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
    public function store(adicionalRequest $request)
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            $nombre = "Sin Foto";
            if ($request->hasFile('fotoAdicional')) {
                /* cargar imagenes con plugin para redimencionar imagenes */
                /* al nombre original del archivo le agrego 10 caracteres random */
                $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoAdicional')->getClientOriginalName();
                /* selecciono la ruta donde queda guardada la imagen con su nombre */
                $url = storage_path() . '\app\public\imagenes/' . $nombre;

                /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
                Image::make($request->file('fotoAdicional'))->resize(300, 200)->save($url);
            }


            if ($request->ajax()) {
                $adicional = new Adicional();
                $adicional->nombreAdicional = $request->nombreAdicional;
                $adicional->precioAdicional = $request->precioAdicional;
                $adicional->descripcionAdicional = $request->descripcionAdicional;
                $adicional->fotoAdicional = '/storage/imagenes/' . $nombre; //guardo la url en la bd
                $adicional->estadoAdicional = $request->estadoAdicional;
                $adicional->subCategoriaAdicional = $request->subCategoriaAdicional;
                $adicional->save();

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
     * Display the specified resource.
     *
     * @param  \App\Models\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function show(Adicional $adicional)
    {
        //
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
            /* decodifico la respuesta para modificar el campo de la foto */
            $array = json_decode($detalleAdicional, true);
            $array[0]["fotoAdicional"] =  asset($array[0]["fotoAdicional"]);
            if ($detalleAdicional) {
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
     * @param  \App\Models\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function update(adicionalRequest $request, Adicional $adicional)
    {
        $formulario = $request->all();
        if ($request->hasFile('fotoAdicional')) {
            /* elimino la imagen anterior */
            $url = str_replace('storage', 'public', $adicional->fotoAdicional);
            Storage::delete($url);
            /* cargar imagenes con plugin para redimencionar imagenes */
            /* al nombre original del archivo le agrego 10 caracteres random */
            $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoAdicional')->getClientOriginalName();
            /* selecciono la ruta donde queda guardada la imagen con su nombre */
            $urlNuevo = storage_path() . '\app\public\imagenes/' . $nombre;

            /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
            Image::make($request->file('fotoAdicional'))->resize(300, 200)->save($urlNuevo);
            $formulario["fotoAdicional"] = '/storage/imagenes/' . $nombre; //guardo la url en la bd
        }

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
            /* Elimino archivo del servidor */
            $url = str_replace('storage', 'public', $adicional->fotoAdicional);
            Storage::delete($url);
            /* Elimino registro de la bd */

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

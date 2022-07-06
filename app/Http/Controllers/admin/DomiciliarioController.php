<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Domiciliario;
use App\Http\Requests\DomiciliarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class DomiciliarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin/domiciliario/index');
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
    public function store(DomiciliarioRequest $request)
    {
        //
        $request->validate([
        'fotoSeguridad' => 'required|',
        ]);
        
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 

            /* Cargar archivos forma normal laravel */
            /* $imagenes = $request->file('fotoSeguridad')->store('public/imagenes');
            $urlImagen = Storage::url($imagenes); */
            // solo queda asignar la urlimagen al campo de la bd y listo

            /* cargar imagenes con plugin para redimencionar imagenes */
            /* al nombre original del archivo le agrego 10 caracteres random */
            $nombre =Str::Random(5) . date('YmdHis') . $request->file('fotoSeguridad')->getClientOriginalName();
            /* selecciono la ruta donde queda guardada la imagen con su nombre */
            $url = storage_path() . '\app\public\imagenes/' .$nombre;
           
            /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
            Image::make($request->file('fotoSeguridad'))->
                    resize(300, null, function ($constraint) { $constraint->aspectRatio();})->
                    save($url);
            
            if ($request->ajax()) { 
                $domiciliario = new Domiciliario();
                $domiciliario->nombreDomiciliario = $request->nombreDomiciliario;
                $domiciliario->apellidoDomiciliario = $request->apellidoDomiciliario;
                $domiciliario->telefonoDomiciliario = $request->telefonoDomiciliario;
                $domiciliario->fotoSeguridad = '/storage/imagenes/'.$nombre; //guardo la url en la bd
                $domiciliario->estadoDomiciliario = $request->estadoDomiciliario;
                $domiciliario->documentoDomiciliario = $request->documentoDomiciliario;
                $domiciliario->save();

                if ($domiciliario->save()) {
                    return response()->json(['success'=>'true']);
                }else { 
                    return response()->json(['success'=>'false']);
                }
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function show(Domiciliario $domiciliario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function edit( $domiciliario)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){            
            $detalleDomiciliario=Domiciliario::select()       
            ->from('domiciliario')
            ->where('domiciliario.id','=',"$domiciliario")
            ->get();
            /* decodifico la respuesta para modificar el campo de la foto */
            $array = json_decode($detalleDomiciliario, true);
            $array[0]["fotoSeguridad"]=  asset($array[0]["fotoSeguridad"]);
            if ($detalleDomiciliario){ 
                return response()->json(['success'=>'true','data'=>$array]);
            }
            else{
                return response()->json(['success'=>'false']);
            }

        }
        else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Domiciliario  $domiciliario)
    {
        //
        $formulario=$request->all();
        if ($request->hasFile('fotoSeguridad')) {
            /* elimino la imagen anterior */
            $url = str_replace('storage','public',$domiciliario->fotoSeguridad);
            Storage::delete($url);
            /* cargar imagenes con plugin para redimencionar imagenes */
            /* al nombre original del archivo le agrego 10 caracteres random */
            $nombre =Str::Random(5) . date('YmdHis') . $request->file('fotoSeguridad')->getClientOriginalName();
            /* selecciono la ruta donde queda guardada la imagen con su nombre */
            $urlNuevo = storage_path() . '\app\public\imagenes/' .$nombre;
           
            /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
            Image::make($request->file('fotoSeguridad'))->
                    resize(300, null, function ($constraint) { $constraint->aspectRatio();})->
                    save($urlNuevo);
            $formulario["fotoSeguridad"] = '/storage/imagenes/'.$nombre; //guardo la url en la bd
        }
        
        $resultado=$domiciliario->fill($formulario)->save(); 
        
        if ($resultado) {
        return response()->json(['success'=>'true']);
        }else {
        return response()->json(['success'=>'false']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domiciliario $domiciliario)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){
            /* Elimino archivo del servidor */
            $url = str_replace('storage','public',$domiciliario->fotoSeguridad);
            Storage::delete($url); 
            /* Elimino registro de la bd */
           
            $resultado=$domiciliario->delete();
            if ($resultado) {
            return response()->json(['success'=>'true']);
            }else {
            return response()->json(['success'=>'false']);
            }
        }else{
            return back();
        }
    }

    public function listar(Request $request){
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){   
            if ($request->filtro!="0" && $request->buscar!="") {
                $datos= Domiciliario::select('domiciliario.*','estados.nombreEstado')
                ->orderBy('created_at','desc')
                ->from('domiciliario')
                ->join('estados','estados.id','=','domiciliario.estadoDomiciliario')
                ->where([
                    ["$request->filtro",'LIKE',"$request->buscar%"]
                    ])
                ->paginate(6);
                return view('admin/domiciliario/includes/tabla')->with('datos',$datos);
                
            }else
            {
                $datos= Domiciliario::select('domiciliario.*','estados.nombreEstado')
                ->orderBy('created_at','desc')
                ->from('domiciliario')
                ->join('estados','estados.id','=','domiciliario.estadoDomiciliario')
                ->paginate(6);
                return view('admin/domiciliario/includes/tabla')->with('datos',$datos);
            }
        }else{
            return back();
        }
    }
}

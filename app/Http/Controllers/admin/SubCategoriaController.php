<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoriaRequest;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin/subCategoria/index');
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
    public function store(SubCategoriaRequest $request)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            if ($request->ajax()) { 
                $subCategoria = new SubCategoria();
                $subCategoria->nombreSubCategoriaPlato = $request->nombreSubCategoriaPlato;
                $subCategoria-> categoria = $request->categoria;
                $subCategoria->estadoSubCategoria = $request->estadoSubCategoria;
                $subCategoria->save();
                if ($subCategoria->save()) {
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
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit( $subCategoria)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            $detalleSubCategoria=SubCategoria::select()       
            ->from('sub_categoria')
            ->where('sub_categoria.id','=',"$subCategoria")
            ->get();
            /* return response()->json($detalleCliente);   */  
            if ($detalleSubCategoria){ 
                return response()->json(['success'=>'true','data'=>$detalleSubCategoria]);
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
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoriaRequest $request,  $subCategoria)
    {
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            if ($request->ajax()) {
                $registro=SubCategoria::findOrFail($subCategoria);
                $formulario=$request->all();
                $resultado=$registro->fill($formulario)->save(); 
                if ($resultado) {
                return response()->json(['success'=>'true']);
                }else {
                return response()->json(['success'=>'false']);
                }
            }  
        }else{
              return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy( $subCategoria)
    {
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            $borrado=SubCategoria::findOrFail($subCategoria);
            $resultado=$borrado->delete();
            if ($resultado) {
            return response()->json(['success'=>'true']);
            }else {
            return response()->json(['success'=>'false']);
            }
        }else{
            return back();
        }
    }

    //consulta para rellenar el select de categoria en index
    public function categoria (Categoria $transportadora)
    {
        $transportadora= Categoria::select()
        ->from('categoria')
        ->get();
        return response()->json($transportadora);
    }

    public function listar(Request $request){
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){   
            if ($request->filtro!="0" && $request->buscar!="") {
                $datos= SubCategoria::select('sub_categoria.*','categoria.nombreCategoriaPlato' ,'estados.nombreEstado')
                ->orderBy('created_at','desc')
                ->from('sub_categoria')
                ->join('estados','estados.id','=','sub_categoria.estadoSubCategoria')
                ->join('categoria','categoria.id','=','sub_categoria.categoria')
                ->where([
                    ["$request->filtro",'LIKE',"$request->buscar%"]
                    ])
                ->paginate(6);
                return view('admin/subCategoria/includes/tabla')->with('datos',$datos);
                
            }else
            {
                $datos= SubCategoria::select('sub_categoria.*','categoria.nombreCategoriaPlato','estados.nombreEstado')
                ->orderBy('created_at','desc')
                ->from('sub_categoria')
                ->join('estados','estados.id','=','sub_categoria.estadoSubCategoria')
                ->join('categoria','categoria.id','=','sub_categoria.categoria')
                ->paginate(6);
                return view('admin/subCategoria/includes/tabla')->with('datos',$datos);
            }
        }else{
            return back();
        }
    }
}

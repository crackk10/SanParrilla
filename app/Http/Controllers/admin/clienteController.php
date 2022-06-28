<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/cliente/index');
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
    public function store( ClienteRequest $request)
    {
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            if ($request->ajax()) { 
                $cliente = new cliente();
                $cliente->nombreCliente = $request->nombreCliente;
                $cliente->apellidoCliente = $request->apellidoCliente;
                $cliente->telefonoCliente = $request->telefonoCliente;
                $cliente->direccion = $request->direccion;
                $cliente->barrio = $request->barrio;
                $cliente->documento = $request->documento;
                $cliente->save();

                if ($cliente->save()) {
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
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit( $cliente)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            
            $detalleCliente=cliente::select()       
            ->from('cliente')
            ->where('cliente.id','=',"$cliente")
            ->get();
            /* return response()->json($detalleCliente);   */  

            if ($detalleCliente){ 
                return response()->json(['success'=>'true','data'=>$detalleCliente]);
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
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request,$cliente)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            if ($request->ajax()) {
            
                $registro=cliente::findOrFail($cliente);
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
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy( $cliente)
    {
        //
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            $borrado=cliente::findOrFail($cliente);
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

    public function listar(Request $request){
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){   
            if ($request->filtro!="0" && $request->buscar!="") {
                $datos= cliente::select('cliente.*')
                ->orderBy('created_at','desc')
                ->from('cliente')
                ->where([
                    ["$request->filtro",'LIKE',"$request->buscar%"]
                    ])
                ->paginate(6);
                return view('admin/cliente/includes/tabla')->with('datos',$datos);
                
            }else
            {
                $datos= cliente::select('cliente.*')
                ->orderBy('created_at','desc')
                ->from('cliente')
                ->paginate(6);
                return view('admin/cliente/includes/tabla')->with('datos',$datos);
            }
        }else{
            return back();
        }
    }
}

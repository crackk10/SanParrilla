<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( auth()->user()->tipoUsuario=="1" &&  auth()->user()->estadoUsuario=="1"){ 
            return true;
        }
        else{
            return false;
        }
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreCliente'=>'required |max:15',
            'apellidoCliente'=>'max:15',
            'telefonoCliente'=>'required|digits_between:7,10|numeric',   
            'direccion'=>'max:20',   
            'barrio'=>'max:20',   
            'documento'=>'max:15',
            'indicacion'=>'max:200',   
        ];   
    }

    public function messages(){
        return [
            'nombreCliente.required'=>'El nombre del cliente es obligatorio!',
            'nombreCliente.max'=>'El nombre tiene mas de 15 caracteres!',
            'telefonoCliente.required'=>'El telefono del cliente es obligatorio!',
            'telefonoCliente.digits_between'=>'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoCliente.numeric'=>'El telefono debe ser solo numeros!',
            'apellidoCliente.max'=>'El apellido tiene mas de 15 caracteres!',
            'direccion.max'=>'La direccion tiene mas de 20 caracteres!',
            'barrio.max'=>'El barrio tiene mas de 20 caracteres!',
            'documento.max'=>'El documento tiene mas de 15 caracteres!',
            'indicacion.max'=>'La indicacion tiene mas de 200 caracteres!',
            

        ];
    }
}

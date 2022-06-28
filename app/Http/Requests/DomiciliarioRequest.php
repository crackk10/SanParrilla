<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomiciliarioRequest extends FormRequest
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
            'nombreDomiciliario'=>'required |max:15',
            'apellidoDomiciliario'=>'required | max:15',
            'telefonoDomiciliario'=>'required|digits_between:7,10|numeric',    
            'estadoDomiciliario'=>'required',   
            'documentoDomiciliario'=>'required | max:15',   
        ];   
    }

    public function messages(){
        return [
            'nombreDomiciliario.required'=>'El nombre del domiciliario es obligatorio!',
            'nombreDomiciliario.max'=>'El nombre tiene mas de 15 caracteres!',
            'telefonoDomiciliario.required'=>'El telefono del domiciliario es obligatorio!',
            'telefonoDomiciliario.digits_between'=>'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoDomiciliario.numeric'=>'El telefono debe ser solo numeros!',
            'apellidoDomiciliario.required'=>'El apellido del domiciliario es obligatorio!',
            'apellidoDomiciliario.max'=>'El apellido tiene mas de 15 caracteres!',
            'estadoDomiciliario'=>'El estado del domiciliario es obligatorio!',
            'documentoDomiciliario.required'=>'El documento del domiciliario es obligatorio!',
            'documentoDomiciliario.max'=>'El documento tiene mas de 15 caracteres!',
            'estadoDomiciliario.required'=>'El estado del domiciliario es obligatorio!',
        ];
    }
}

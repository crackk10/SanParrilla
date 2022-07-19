<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatoRequest extends FormRequest
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
            'nombrePlato'=>'required |max:30',
            'precio'=>'required|numeric',
            'descripion'=>'max:200',
            'subCategoriaPlato'=>'required',
            'estadoPlato'=>'required',
        ];   
    }

    public function messages(){
        return [
            'nombrePlato.required'=>'El nombre del plato es obligatorio!',
            'nombrePlato.max'=>'El nombre tiene mas de 30 caracteres!',
            'precio.required'=>'El precio del plato es obligatorio!',
            'precio.numeric'=>'El precio debe ser solo numeros!',
            'descripcion.max'=>'La descripcion tiene mas de 200 caracteres!',
            'subCategoriaPlato.required'=>'La categoria del plato es obligatorio!',
            'estadoPlato.required'=>'El estado del plato es obligatorio!',       
        ];
    }
}

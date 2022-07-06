<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nombreCategoriaPlato'=>'required |max:15',
            'estadoCategoria'=>'required',
        ];   
    }

    public function messages(){
        return [
            'nombreCategoriaPlato.required'=>'El nombre de la categoria es obligatorio!',
            'nombreCategoriaPlato.max'=>'El nombre tiene mas de 15 caracteres!',
            'estadoCategoria.required'=>'El estado de la categoria es obligatorio!',  
        ];
    }
}

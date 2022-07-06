<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoriaRequest extends FormRequest
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
            'nombreSubCategoriaPlato'=>'required |max:15',
            'estadoSubCategoria'=>'required ',
            'categoria'=>'required ',
        ];   
    }

    public function messages(){
        return [
            'nombreSubCategoriaPlato.required'=>'El nombre de la sub categoria es obligatorio!',
            'nombreSubCategoriaPlato.max'=>'El nombre tiene mas de 15 caracteres!',
            'estadoSubCategoria.required'=>'El estado de la sub sub categoria es obligatorio!',  
            'categoria.required'=>'La categoria es obligatoria!',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adicionalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            return true;
        } else {
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
            'nombreAdicional' => 'required |max:30',
            'precioAdicional' => 'required|numeric',
            'subCategoriaAdicional' => 'required',
            'estadoAdicional' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombreAdicional.required' => 'El nombre del Adicional es obligatorio!',
            'nombreAdicional.max' => 'El nombre tiene mas de 30 caracteres!',
            'precioAdicional.required' => 'El precio del Adicional es obligatorio!',
            'precioAdicional.numeric' => 'El precio debe ser solo numeros!',
            'subCategoriaAdicional.required' => 'La categoria del Adicional es obligatorio!',
            'estadoAdicional.required' => 'El estado del Adicional es obligatorio!',
        ];
    }
}

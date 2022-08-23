<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'cliente' => 'required',
            'tipoPago' => 'required',
            'tipoPedido' => 'required',
            'total' => 'required | min:2',
        ];
    }

    public function messages()
    {
        return [
            'cliente.required' => 'El nombre del cliente es obligatorio!',
            'tipoPago.required' => 'El tipo de pedido es obligatorio!',
            'tipoPedido.required' => 'El tipo de pago es obligatorio!',
            'total.required' => 'El carrito esta vacio!',
            'total.min' => 'El carrito esta vacio!',
        ];
    }
}

<?php

namespace GestionDePedidos\Http\Requests;

use GestionDePedidos\Http\Requests\Request;

class ClienteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'telefono'=>'required|max:8|min:8',
            'direccion'=>'required|max:200',
        ];
    }
}

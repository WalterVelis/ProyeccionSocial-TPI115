<?php

namespace GestionDePedidos\Http\Requests;

use GestionDePedidos\Http\Requests\Request;

class OfertaRequest extends Request
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
            'idproducto'=>'required',
            'descuento'=>'required|numeric',
            'descripcion'=>'required|max:250',
        ];
    }
}

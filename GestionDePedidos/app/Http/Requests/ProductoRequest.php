<?php

namespace GestionDePedidos\Http\Requests;

use GestionDePedidos\Http\Requests\Request;

class ProductoRequest extends Request
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
            'idcategoria'=>'required',
            'codigo'=>'required|max:12|min:12',
            'nombre'=>'required|max:50',
            'descripcion'=>'max:250',
            'imagen'=>'mimes:jpeg,tmp,png',
            'precio'=>'required|numeric'
        ];
    } 
}

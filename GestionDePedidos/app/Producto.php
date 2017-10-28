<?php

namespace GestionDePedidos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto';

    protected $primaryKey='idproducto';

    public $timestamps=false;


    protected $fillable =[
    	'idcategoria',
    	'codigo',
    	'nombreproducto',
    	'descripcionproducto',
    	'imagen',
    	'precio',
    	'estadoproducto',
    	'puntuacion'
    ];

    protected $guarded =[

    ];
}

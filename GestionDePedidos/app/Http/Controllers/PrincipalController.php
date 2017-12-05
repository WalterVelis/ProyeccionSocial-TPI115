<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use GestionDePedidos\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use GestionDePedidos\Http\Requests\ProductoRequest;
use GestionDePedidos\Producto;
use Carbon\Carbon;
use DB;

class PrincipalController extends Controller
{
     public function __construct()
    {

    }
    
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $productos=DB::table('producto as p')
            ->join('categoria as c','c.idcategoria','=','p.idcategoria')
            ->select('p.idproducto','p.codigo','p.nombreproducto as nombre','p.descripcionproducto as descripcion','p.foto','p.precio','p.estadoproducto as estado','c.nombrecategoria as categoria','c.idcategoria')
            ->where('p.nombreproducto','LIKE','%'.$query.'%')
            ->where('p.estadoproducto','=','1')
            ->where('c.condicion','=','1')
            ->orderBy('p.idcategoria','desc')
            ->paginate(9);

            $categorias=DB::table('categoria as c')
            ->select('c.idcategoria','c.nombrecategoria as categoria','c.condicion')
            ->where('c.condicion','=','1')
            ->get();

            return view('admin.inicio.index',["productos"=>$productos,"categorias"=>$categorias,"searchText"=>$query]);
        }

    
    }

    public function show($id)
    {
        $productos=DB::table('producto as p')
        ->join('categoria as c','c.idcategoria','=','p.idcategoria')
        ->select('p.idproducto','p.codigo','p.nombreproducto as nombre','p.descripcionproducto as descripcion','p.foto','p.precio','p.estadoproducto as estado','c.nombrecategoria as categoria','c.idcategoria')
        ->where('c.idcategoria','=',$id)
        ->where('p.estadoproducto','=','1')
        ->orderBy('c.idcategoria','desc')
        ->paginate(9);

        $categorias=DB::table('categoria as c')
        ->select('c.idcategoria','c.nombrecategoria as categoria','c.condicion')
        ->where('c.condicion','=','1')
        ->get();

        return view('layouts.principal',["productos"=>$productos,"categorias"=>$categorias]);    
    }

}

<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use GestionDePedidos\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use GestionDePedidos\Http\Requests\ProductoRequest;
use GestionDePedidos\Producto;
use DB;

class ProductoController extends Controller
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
            ->select('p.idproducto','p.codigo','p.nombreproducto as nombre','p.descripcionproducto as descripcion','p.imagen','p.precio','p.estadoproducto as estado','c.nombrecategoria as categoria')
            ->where('p.nombreproducto','LIKE','%'.$query.'%')
            ->orderBy('p.idcategoria','desc')
            ->paginate(7);
            return view('admin.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }
    public function create()
    {
          $categorias=DB::table('categoria as c')
        ->select('c.idcategoria','c.nombrecategoria as categoria')->get();
        
    	return view("admin.producto.create",["categorias"=>$categorias]);
    }
    public function store (ProductoRequest $request)
    {
        $producto=new Producto;
        $producto->codigo=$request->get('codigo');
        $producto->nombreproducto=$request->get('nombre');
        $producto->descripcionproducto=$request->get('descripcion');
        $producto->idcategoria=$request->get('idcategoria');
        $producto->precio=$request->get('precio');
        $producto->estadoproducto='1';
        $producto->save();
        return Redirect::to('admin/producto');

    }
    public function show($id)
    {
        return view("admin.producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id)
    {
        $categorias=DB::table('categoria as c')
        ->select('c.idcategoria','c.nombrecategoria as categoria')
        ->get();

        return view("admin.producto.edit",["categorias"=>$categorias,"producto"=>Producto::findOrFail($id)]);
    }
    public function update(ProductoRequest $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->codigo=$request->get('codigo');
        $producto->nombreproducto=$request->get('nombre');
        $producto->descripcionproducto=$request->get('descripcion');
        $producto->idcategoria=$request->get('idcategoria');
        $producto->precio=$request->get('precio');
        $producto->estadoproducto='1';
        $producto->update();

        return Redirect::to('admin/producto');
    }
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->estadoproducto='0';
        $producto->update();
        return Redirect::to('admin/producto');
    }
}

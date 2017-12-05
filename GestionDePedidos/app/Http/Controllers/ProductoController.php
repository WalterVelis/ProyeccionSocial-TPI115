<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use GestionDePedidos\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use GestionDePedidos\Http\Requests\ProductoRequest;
use GestionDePedidos\Producto;
use Carbon\Carbon;
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
            ->select('p.idproducto','p.codigo','p.nombreproducto as nombre','p.descripcionproducto as descripcion','p.foto','p.precio','p.estadoproducto as estado','c.nombrecategoria as categoria')
            ->where('p.nombreproducto','LIKE','%'.$query.'%')
            ->orderBy('p.idcategoria','desc')
            ->paginate(7);
            return view('admin.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $categorias=DB::table('categoria as c')
        ->select('c.idcategoria','c.nombrecategoria as categoria')
        ->where('condicion','=','1')->get();
        
    	return view("admin.producto.create",["categorias"=>$categorias]);
    }
    public function store (ProductoRequest $request)
    {
        $producto=new Producto;

        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            $file->move(public_path().'/img/productos',Carbon::now()->second.$file->getClientOriginalName());
            $producto->foto=Carbon::now()->second.$file->getClientOriginalName();
        }

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
        ->where('condicion','=','1')->get();

        return view("admin.producto.edit",["categorias"=>$categorias,"producto"=>Producto::findOrFail($id)]);
    }
    public function update(ProductoRequest $request,$id)
    {
        if(Input::hasfile('foto')){
            
            $file=Input::file('foto');
            $producto=Producto::findOrFail($id);
            $fotovieja=$producto->FOTO;
            if(is_file(public_path().'/img/productos/'.$fotovieja)){
                unlink(public_path().'/img/productos/'.$fotovieja);
                } 
            $file->move(public_path().'/img/productos',Carbon::now()->second.$file->getClientOriginalName());
            
            $affectedRows = Producto::where('idproducto','=',$id)
            ->update(['codigo'=>$request->get('codigo'),
            'nombreproducto'=> $request->get('nombre'),
            'descripcionproducto' =>$request->get('descripcion'),
            'idcategoria' =>$request->get('idcategoria'),
            'precio' =>$request->get('precio'),
            'foto'=>Carbon::now()->second.$file->getClientOriginalName()]);

        }else{
            $affectedRows = Producto::where('idproducto','=',$id)
            ->update(['codigo'=>$request->get('codigo'),
            'nombreproducto'=> $request->get('nombre'),
            'descripcionproducto' =>$request->get('descripcion'),
            'idcategoria' =>$request->get('idcategoria'),
            'precio' =>$request->get('precio')]);
        }

        /*$producto=Producto::findOrFail($id);
        $producto->codigo=$request->get('codigo');
        $producto->nombreproducto=$request->get('nombre');
        $producto->descripcionproducto=$request->get('descripcion');
        $producto->idcategoria=$request->get('idcategoria');
        $producto->precio=$request->get('precio');
        $producto->update();
        */

        return Redirect::to('admin/producto');
    }
    
    public function destroy($id)
    {
        $affectedRows = Producto::where('idproducto','=',$id)->delete();
        return Redirect::to('admin/producto');

    }

    public function estado($id)
    {
        $producto=Producto::findOrFail($id);
        if($producto->estadoproducto=='0')
             $producto->estadoproducto='1';
         else
            $producto->estadoproducto='0';

        $producto->update();
        return Redirect::to('admin/producto');
    }

}

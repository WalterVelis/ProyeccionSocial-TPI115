<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;

use GestionDePedidos\Http\Requests;
use GestionDePedidos\Categoria;
use Illuminate\Support\Facades\Redirect;
use GestionDePedidos\Http\Requests\CategoriaRequest;
use DB;

class CategoriaController extends Controller
{
	public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categoria')->where('nombrecategoria','LIKE','%'.$query.'%')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            return view('admin.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("admin.categoria.create");
    }
    public function store (CategoriaRequest $request)
    {
        $categoria=new Categoria;
        $categoria->nombrecategoria=$request->get('nombre');
        $categoria->descripcioncategoria=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('admin/categoria');

    }
    public function show($id)
    {
        return view("admin.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("admin.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombrecategoria=$request->get('nombre');
        $categoria->descripcioncategoria=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('admin/categoria');
    }
    
    public function destroy($id)
    {
        $affectedRows = Categoria::where('idcategoria','=',$id)->delete();
        return Redirect::to('admin/categoria');

    }

    public function estado($id)
    {
        $categoria=Categoria::findOrFail($id);
        if($categoria->condicion=='0')
             $categoria->condicion='1';
         else
            $categoria->condicion='0';
    
        $categoria->update();
        return Redirect::to('admin/categoria');
    }
}

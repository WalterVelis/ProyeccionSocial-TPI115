<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use GestionDePedidos\Http\Requests;

use GestionDePedidos\Oferta;
use Illuminate\Support\Facades\Redirect;
use GestionDePedidos\Http\Requests\OfertaRequest;
use DB;


class OfertaController extends Controller
{
    public function __construct()
    {

    }
    
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $ofertas=DB::table('oferta as o')
            ->join('producto as p','p.idproducto','=','o.idproducto')
            ->select('o.idoferta','o.idproducto','o.descuento','o.descripcionoferta as descripcion','p.codigo','p.nombreproducto as producto','o.estadooferta as estado')
            ->where('p.nombreproducto','LIKE','%'.$query.'%')
            ->orderBy('o.idoferta','desc')
            ->paginate(7);
            return view('admin.oferta.index',["ofertas"=>$ofertas,"searchText"=>$query]);
        }
    }
    
    public function create()
    {
        $productos=DB::table('producto as p')
        ->select('p.idproducto','p.nombreproducto as producto')
        ->where('p.estadoproducto','=','1')->get();

        return view("admin.oferta.create",["productos"=>$productos]);
    }
    
    public function store (OfertaRequest $request)
    {
        $oferta=new Oferta;
        $oferta->idproducto=$request->get('idproducto');
        $oferta->descuento=$request->get('descuento');
        $oferta->descripcionoferta=$request->get('descripcion');
        $oferta->estadooferta='0';
        $oferta->save();
        return Redirect::to('admin/oferta');

    }
    
    public function show($id)
    {
        return view("admin.oferta.show",["oferta"=>Oferta::findOrFail($id)]);
    }
    
    public function edit($id)
    {
        $productos=DB::table('producto as p')
        ->select('p.idproducto','p.nombreproducto as producto')
        ->where('p.estadoproducto','=','1')->get();

        return view("admin.oferta.edit",["productos"=>$productos,"oferta"=>Oferta::findOrFail($id)]);
    }
    
    public function update(OfertaRequest $request,$id)
    {
        $oferta=Oferta::findOrFail($id); 
        $oferta->idproducto=$request->get('idproducto');
        $oferta->descuento=$request->get('descuento');
        $oferta->descripcionoferta=$request->get('descripcion');
        $oferta->update();
        return Redirect::to('admin/oferta');
    }
    
    public function destroy($id)
    {
        $affectedRows = Oferta::where('idoferta','=',$id)->delete();
        return Redirect::to('admin/oferta');

    }

    public function estado($id)
    {
        $oferta=Oferta::findOrFail($id);
        if($oferta->estadooferta=='0')
             $oferta->estadooferta='1';
         else
            $oferta->estadooferta='0';
    
        $oferta->update();
        return Redirect::to('admin/oferta');
    }
}

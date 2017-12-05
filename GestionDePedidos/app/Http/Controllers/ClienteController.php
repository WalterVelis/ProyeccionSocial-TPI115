<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use GestionDePedidos\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use GestionDePedidos\Http\Requests\ClienteRequest;
use GestionDePedidos\Cliente;
use DB;

class ClienteController extends Controller
{
    public function __construct()
    {

    }
    
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $clientes=DB::table('cliente as c')
            ->select('c.idcliente',DB::raw("CONCAT(c.nombrecliente,' ', c.apellidocliente) as nombre"),'c.username','c.telefono','c.email')
            ->where('c.nombrecliente','LIKE','%'.$query.'%')
            ->orderBy('c.idcliente','desc')
            ->paginate(7);
            return view('admin.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }
    public function create()
    {   
    	return view("admin.cliente.create");
    }

    public function store (ClienteRequest $request)
    {
        $cliente=new Cliente;
        $cliente->nombrecliente=$request->get('nombre');
        $cliente->apellidocliente=$request->get('apellido');
        $cliente->username=$request->get('username');
        $cliente->password=$request->get('password');
        $cliente->telefono=$request->get('telefono');
        $cliente->celular=$request->get('celular');
        $cliente->direccion=$request->get('direccion');
        $cliente->email=$request->get('email');
        $cliente->save();
        return Redirect::to('admin/cliente');

    }
    public function show($id)
    {
        return view("admin.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("admin.cliente.edit",["cliente"=>Cliente::findOrFail($id)]);
    }
    
    public function update(ClienteRequest $request,$id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->nombrecliente=$request->get('nombre');
        $cliente->apellidocliente=$request->get('apellido');
        $cliente->username=$request->get('username');
        $cliente->password=$request->get('password');
        $cliente->telefono=$request->get('telefono');
        $cliente->celular=$request->get('celular');
        $cliente->direccion=$request->get('direccion');
        $cliente->email=$request->get('email');
        $cliente->update();

        return Redirect::to('admin/cliente');
    }
    
    public function destroy($id)
    {
        $affectedRows = Cliente::where('idcliente','=',$id)->delete();
        return Redirect::to('admin/cliente');

    }
}

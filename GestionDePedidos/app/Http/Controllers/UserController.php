<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;

use GestionDePedidos\Http\Requests;
use GestionDePedidos\User;
use GestionDePedidos\Cliente;
use Illuminate\Support\Facades\Redirect;
use GestionDePedidos\Http\Requests\UserRequest;
use DB;

class UserController extends Controller
{
    public function activate($code)
    {
      $users = User::where('code',$code);
      $exist = $users->count();
      $user = $users->first();
      if($exist == 1 and $user->active == 0)
      {
        $id = $user->id;
        return view('auth.complete_record',compact('id'));
      }else{
        return redirect::to('/');
      }
    }
    public function complete(UserRequest $request,$id)
    {
      $user = User::find($id);
      $user->password = bcrypt($request->password);
      $user->active = 1;
      $user->save();

      $cliente=new Cliente;
        $cliente->nombrecliente=$request->get('nombre');
        $cliente->apellidocliente=$request->get('apellido');
        $cliente->username=$user->name;
        $cliente->password=$user->password;
        $cliente->telefono=$request->get('telefono');
        $cliente->direccion=$request->get('direccion');
        $cliente->email=$user->email;
        $cliente->save();
      
      return redirect::to('/admin/inicio');
    }
}

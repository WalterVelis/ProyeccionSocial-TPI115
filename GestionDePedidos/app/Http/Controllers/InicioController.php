<?php

namespace GestionDePedidos\Http\Controllers;

use Illuminate\Http\Request;
use sisGerencial\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class InicioController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {  	
    	return view('Bienvenido');
    }

}

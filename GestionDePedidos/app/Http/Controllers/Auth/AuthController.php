<?php

namespace GestionDePedidos\Http\Controllers\Auth;

use GestionDePedidos\User;
use Validator;
use GestionDePedidos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/response';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        */

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/

        $code = $this->generarCodigo(10);
        $email = $data['email'];
        $dates = array('name'=> $data['name'],'code' => $code);
        $this->Email($dates,$email);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'code' => $code,
        ]);
    }

    public function generarCodigo($longitud)
    {
         $key = '';
         $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
         $max = strlen($pattern)-1;

         for($i=0;$i < $longitud;$i++) 
            $key .= $pattern{mt_rand(0,$max)};

         return $key;
    }

    function Email($dates,$email){
      Mail::send('email.plantilla_email',$dates, function($message) use ($email){
        $message->subject('Bienvenido a la plataforma');
        $message->to($email);
        $message->from('waltervelis45@gmail.com','Creaciones Artisticas');
      });
    }
}

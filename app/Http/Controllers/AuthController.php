<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash; //PARA DESIFRAR LA CLAVE ENCRIPTADA
use Iluminate\Http\Response;


class AuthController extends Controller
{
    //METODO PARA REGISTRAR UN USUARIO
    //USANDO LOS CAMPOS QUE SE ENCUENTAN EN LA MIGRACION USUARIOS
    public function register(Request $request){

        //SE VALIDARAN LOS CAMPOS CORRESPONDIENTES
        $campos = $request->validate([
            'name' => 'required|string', 
            'email' => 'required|string|unique:users,email',// CAMPO REQUERIDO, QUE SEA UN STRING Y UE SEA UNICO Y SE COMPARARA CON EL CAMPO EMAIL
            'password' => 'required|string|confirmed' //CAMPO REQUERIDO, ENTERO Y QUE SE CONFIRME CON EL CAMPO (password_confirmation)
            ]
        );

        //SE REGISTRARA EL USUARIO ENVIADO POR METODO POST
        $usuario = User::create([
            'name' => $campos['name'],
            'email' => $campos['email'],
            'password' => bcrypt($campos['password'])// SE USA LA FUNCION bcrypt PARA ENCRIPTAR LA PASSWORD
        ]);

        $token = $usuario->createToken('myapptoken')->plainTextToken; // SE CREA EL TOKEN EN FORMATO PLANO

        $response = [
            'user' => $usuario,
            'token' => $token
        ];

        return response($response,201);
    }

    public function logout(Request $request){ //DESLOGEAR USUARIO 
        auth()->user()->tokens()->delete();
        return  [
            'mensaje' => 'Desconectado'
        ];
    }

    public function login(Request $request){//LOGUEAR USUARIO
        $campos = $request->validate([ // SE VALIDAN LOS CMAPOS LOGIN Y PASSWORD
            'email' => 'required|string',
            'password' => 'required|string'
            ]
        );

        //chequear EMAIL
        // se consulta la tabla user, el campo EMAIL y que busque el primer registro
        $usuario = User::where('email', $campos['email'])->first();

        //chequea  SI SE CNSIGUIO EL EMAIL Y SI LO CONSIGUE CHEQUEA LA contrase;a
        if (!$usuario || !FacadesHash::check($campos['password'], $usuario->password)){
            return response([
                'mensaje' => 'Usuario no Registrado'
            ],401);
        }

        $token = $usuario->createToken('myapptoken')->plainTextToken;

        $response = [
            'usuario' => $usuario,
            'token'   => $token
        ];

        return response($response, 201);

    }
}

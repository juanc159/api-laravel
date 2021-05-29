<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Iluminate\Http\Response;


class AuthController extends Controller
{
    //

    public function register( Request $request){
        $campos = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
            ]
        );

        $usuario = User::create([
            'name' => $campos['name'],
            'email' => $campos['email'],
            'password' => bcrypt($campos['password'])
        ]);

        $token = $usuario->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $usuario,
            'token' => $token
        ];

        return response($response,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return  [
            'mensaje' => 'Desconectado'
        ];
    }

    public function login(Request $request){
        $campos = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
            ]
        );

        //chequear EMAIL
        // se consulta la tabla user, el campo EMAIL y que busque el primer registro
        $usuario = User::where('email', $campos['email'])->first();

        //chequea contrase;a
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

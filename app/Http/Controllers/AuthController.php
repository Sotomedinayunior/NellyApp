<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Registro de un nuevo usuario.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        return response()->json([
            'message' => 'Usuario creado satisfactoriamente'
        ], 201);
    }

    /**
     * Inicio de sesión del usuario y generación de token de acceso.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('NombreDelCliente')->accessToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'No autorizado'], 401);
    }

    /**
     * Cierre de sesión del usuario (anula el token).
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json([
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }
}

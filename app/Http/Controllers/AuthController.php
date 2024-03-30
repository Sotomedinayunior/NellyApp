<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


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
    try {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
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
    } catch (ValidationException $e) {
        // Captura la excepción de validación y devuelve los errores de validación
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        // Captura cualquier otra excepción y devuelve un mensaje de error genérico
        return response()->json(['message' => 'Ocurrió un error al registrar el usuario'], 500);
    }
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
        return response()->json(['token' => $token, 'user_id' => $user->id], 200);
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
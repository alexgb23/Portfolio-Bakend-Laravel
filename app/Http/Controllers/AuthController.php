<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar al usuario por email
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Crear el token de acceso
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'Login correcto',
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        // Revocar (borrar) el token actual para cerrar sesión de forma segura
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ], 200);
    }
}

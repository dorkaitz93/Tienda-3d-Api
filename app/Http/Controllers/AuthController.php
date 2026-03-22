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

        $user = User::where('email', $request->email)->first();

        // Si el usuario no existe o la contraseña no es la del Seeder...
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales no válidas'], 401);
        }

        // Generamos el Token (La llave)
        $token = $user->createToken('token-tienda')->plainTextToken;

        return response()->json([
            'mensaje' => 'Bienvenido al búnker',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['mensaje' => 'Token eliminado, sesión cerrada']);
    }
}

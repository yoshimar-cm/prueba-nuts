<?php

namespace App\Http\Controllers\Passport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\LoginUserRequest;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * [Crear nueva cuenta]
     * Crea un nuevo usuario y regresa un token
     */
    public function signup(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Token')->accessToken;

        return response()->json(['token' => $token], 201);
    }



    /**
     * [iniciar sesión]
     * Obtiene la información, busca el usuario y regresa un token
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 201);
        }else{
            return response()->json(['error' => 'Incorrect credentials'], 404);
        }

    }




    /**
     * [Cerrar sesion]
     * Optiene el token del usuario actual y retira el token
     */
    public function logout()
    {
        $token = auth()->user()->token();
        $token->revoke();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}

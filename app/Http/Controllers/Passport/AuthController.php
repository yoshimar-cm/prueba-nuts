<?php

namespace App\Http\Controllers\Passport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }



    /**
     * Undocumented function
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 200);
        }else{
            return response()->json(['error' => 'Incorrect credentials'], 404);
        }

    }




    /**
     * Undocumented function
     */
    public function logout()
    {
        $token = auth()->user()->token();

        $token->revoke();

        return response()->json(['success' => 'Logout successfully'], 200);
    }
}

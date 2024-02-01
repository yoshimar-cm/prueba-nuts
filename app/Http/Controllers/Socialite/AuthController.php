<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     *
     */
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }


    /**
     *
     */
    public function callback(){
        $user = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'email' => $user->getEmail(),
        ],[
            'name' => $user->getName(),
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}

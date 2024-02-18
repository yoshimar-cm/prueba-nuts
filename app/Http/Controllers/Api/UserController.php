<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function show(): UserResource
    {
        $user = auth()->user();
        return UserResource::make($user);
    }



    public function update(UpdateUserRequest $request)
    {

        $user = auth()->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();


        return response()->json(['success' => 'Update successfully'], 200);

    }



    public function delete(){

        $user = auth()->user();

        $user->delete();

        auth()->user()->token()->revoke();

        return response()->json([
            'success' => 'Delete successfully'
        ],200);
    }




}

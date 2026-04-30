<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $auth = Auth::attempt($request->only('email','password'));
        // When not auth user then show this
        if (!$auth)
        {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ],401); // 401 is 'HTTP error code'
        }
        $user = Auth::user(); // Auth user
        $token = $user->createToken('api-token')->plainTextToken; // token create

        return response()->json([
            'status'    => true,
            'message'   => 'Login successfully!',
            'token'     => $token,
            'user'      => $user
        ]);



    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            // create token for logged user
            $token = Auth::user()->createToken($request->input('email'))->plainTextToken;

            return response()->json(['result' => true, "user" => Auth::user(), "token" => $token], 200);
        }
        return response()->json(["result" => false, "error" => "rasoul 123"], 401);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdministratorSchema;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        $credential = request(['email', 'password']);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('administrator_schemas')->attempt($credentials)) {
            $employee = AdministratorSchema::where('email', $request->email)->first();
            $token = $employee->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);




        // if (Auth::attempt($request->only(['email',  'password']))) {
        //     // create token for logged user
        //     $token = Auth::user()->createToken($request->input('email'))->plainTextToken;

        //     return response()->json(['result' => true, "user" => Auth::user(), "token" => $token], 200);
        // }
        // return response()->json(["result" => false, "error" => "rasoul 123"], 401);
    }
}

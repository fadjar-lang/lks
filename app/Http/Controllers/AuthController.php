<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|dns:unique',
            'password' => 'required|min:5'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('nApp')->accesToken;
        return response()->json(['message' => 'berhasil terdaftar', 'token' => $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth()->attempt($credentials)) {
            $token = Auth()->user()->createToken('nApp')->accessToken;
            return response()->json(['message' => 'berhasil login', 'token' => $token], 200);
        }else{
            return response()->json(['message' => 'Unautorizhed'], 401);
        }
    }

    public function logout(Request $request)
    {
       $token = $request->user()->token();
       $token->revoke();
       return response()->json(['message'=>'berhasil logout'], 200);
    }
}

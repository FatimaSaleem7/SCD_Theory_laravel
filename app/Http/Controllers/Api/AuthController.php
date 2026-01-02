<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login using the same table Breeze uses
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // This generates the Passport Bearer Token
            $token = $user->createToken('ApiAccessToken')->accessToken;

            return response()->json([
                'success' => true,
                'user' => $user->name,
                'token' => $token
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Revoke the specific token used for this request
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
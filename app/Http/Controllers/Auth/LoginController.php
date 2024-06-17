<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // return view('auth.login'); // Replace with your login form view path
    }

    public function login(Request $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => "Failed to login"], 401);
        }

        $token = auth()->user()->createToken('personal-token', expiresAt:now()->addDay())->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request)
    {

    }
}

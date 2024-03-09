<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],

        ]);

        //check if user exists or create new user
        $user = User::where('email', $request->email)->first();

        return response()->json(['token' => $user->createToken($request->email)->plainTextToken]);
    }
}

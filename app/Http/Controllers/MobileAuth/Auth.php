<?php

namespace App\Http\Controllers\MobileAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth extends Controller
{
    public function login(Request $request){

        return response()->json([
            'received' => [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]
        ]);
    }
}

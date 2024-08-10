<?php

namespace App\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService {
    
    public function register(Request $request) {
        $created_user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $created_user;
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        return auth()->attempt($credentials);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthResource;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $this->authService->register($request);
        $token = auth()->login($user);
        if ($user && $token) {
            return new AuthResource([
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $credentials = $request->only('email', 'password');
        $token = $this->authService->login($request);

        if($token) {
            return new AuthResource([
                'user' => auth()->user(),
                'token' => $token
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
        

        return auth()->attempt($credentials);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Constant\ErrorHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->error('Credenciales invalidas', ErrorHttp::UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('Token de acceso personal')->accessToken;

        return $this->response('Login exitoso', [
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return $this->response('Se ha cerrado la sesión correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use JWTAuth;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
     
      $credentials = $request->only('nome', 'senha');

      $usuario = Usuario::where('nome', $credentials['nome'])->first();

      if(!$usuario) {
        return response()->json([
          'error' => 'Credenciais Invalidas'
        ], 401);
      }

      if ($credentials['senha'] != $usuario->senha) {
          return response()->json([
            'error' => 'Credenciais Invalidas'
          ], 401);
      }

      $token = JWTAuth::fromUser($usuario);
      $objectToken = JWTAuth::setToken($token);
      $expiration = JWTAuth::decode($objectToken->getToken())->get('exp');

      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => $expiration
      ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use JWTAuth;
use Validator;
use App\Http\Requests\AuthenticateRequest;

class AuthController extends Controller
{
    public function authenticate(AuthenticateRequest $request) {
     
      $credentials = $request->only('nome', 'senha');

      $validator = Validator::make($credentials, [
          'senha' => 'required',
          'nome' => 'required'
      ]);

      if($validator->fails()) {
          return response()->json([
              'message'   => 'Credenciais Invalidas',
              'errors'        => $validator->errors()->all()
          ], 422);
      }

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
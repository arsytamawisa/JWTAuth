<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Login as LoginRequest;

class LoginController extends Controller
{
    function login(LoginRequest $request)
    {
         $credentials = $request->only('email', 'password');

         if(!$token = auth()->attempt($credentials)){
              return response()->json(['error' => 'invalid_credentials'], 401);
         }

         return (new UserResource($request->user()))
               ->additional(['meta' => [
                   'token' => $token,
               ]]);
    }
}

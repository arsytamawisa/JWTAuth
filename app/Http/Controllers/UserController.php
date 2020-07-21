<?php

namespace App\Http\Controllers;

use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
     function user(Request $request)
     {
          try{
               $user = JWTAuth::parseToken()->authenticate();
          }
          catch(Exception $e){
               if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json(['error' => 'token_invalid'], 400);
               }
               elseif($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
               {
                    return response()->json(['error' => 'token_expired'], 400);
               }
               else{
                    return response()->json(['error' => 'token_not_found'], 401);
               }
          }
          
          return new UserResource($user);
     }
}

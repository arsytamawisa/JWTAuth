<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Register as RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
     public function register(RegisterRequest $request)
     {
          $user = User::create([
               'name'         => $request->name,
               'email'        => $request->email,
               'password'     => bcrypt($request->password),
          ]);

          $credentials = $request->only('email', 'password');

          $token = auth()->attempt($credentials);

          // Menggabungkan data user dan token kemudian mengembalikan data dalam format json
          // return response()->json(compact('user','token'));

          // Mengembalikan data user melalui UserResource
          // return new UserResource($user);

          return (new UserResource($request->user()))
                ->additional(['meta' => [
                    'token' => $token,
                ]]);
     }


}

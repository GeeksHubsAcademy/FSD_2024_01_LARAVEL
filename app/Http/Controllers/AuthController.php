<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            Log::info('REGISTERING USER');
            // Recuperar la info
            $name = $request->input('name');
            $nickname = $request->input('nickname');
            $password = $request->input('password');
            $email = $request->input('email');

            // Validarla
            $validator = Validator::make($request->all(), [
                'nickname' => 'required|unique:users|max:50',
                'name' => 'required',
                'password' => 'required|min:4|max:10',
                'email' => 'required|unique:users'
            ]);
     
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Validation failed",
                        "error" => $validator->errors()
                    ]
                );
            }

            // Tratar la info
            $hashPassword = bcrypt($password);

            // Guardar en BD
            $newUser = new User;
            $newUser->name = $name;
            $newUser->nickname = $nickname;
            $newUser->email = $email;
            $newUser->password = $hashPassword;

            $newUser->save();

            // Devolvet la respuesta 

            return response()->json(
                [
                    "success" => true,
                    "message" => "user registered",
                    "data" => $newUser
                ],
                201
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "user cant be registered",
                    // "error" => $th->getMessage()
                ]
            );
        }
    }
}

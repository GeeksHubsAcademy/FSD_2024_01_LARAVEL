<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function login(Request $request) {
        try {
            // recuperar la request
            $email = $request->input('email');
            $password = $request->input('password');

               // Validarla
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required'
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

            // Comprobar si el usuario existe
            $user = User::query()
                ->where('email', $email)
                ->first();

            if(!$user) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid",
                        // "error" => $th->getMessage()
                    ],
                    400
                );
            }

            // Validar password con el usuario
            $checkPasswordUser = Hash::check($password, $user->password);
            
            if(!$checkPasswordUser) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid 2",
                        // "error" => $th->getMessage()
                    ],
                    400
                );
            }
            
            // Crear token
            $token =$user->createToken('api-token')->plainTextToken;

            // Responder con el token
            return response()->json(
                [
                    "success" => true,
                    "message" => "user logged",
                    "token" => $token
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "user cant be logged",
                    // "error" => $th->getMessage()
                ]
            );
        }
    }
}

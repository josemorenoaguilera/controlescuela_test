<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //funcion para validar login de usuario
    public function login(Request $request)
    {
        $credentials = [
            'email'      => $request->email,
            'password'   => $request->password
        ];
        if(Auth::attempt($credentials)) {
            $success = true;
            $msg = 'Logeado correctamente.';
        } else {
            $success = false;
            $msg = 'Logeado incorrecto.';
        }
        $response = [
            'success' => $success,
            'message' => $msg
        ];
        return response()->json($response);
    }

    public function logout() 
    {
        try {
            Session::flush();
            $success = true;
            $msg     = 'Cerro sesión correctamente.';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $msg     = $ex->getMessage();
        }
        $response = [
            'success' => $success,
            'message' => $msg
        ];
        return response()->json($response);
    }

    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $response = [
                'success' => true,
                'message' => 'Se guardo correctamente.'
            ];
        } catch (\Illuminate\Database\QueryException $ex) {
            $response = [
                'success' => false,
                'message' => $ex->gerMessage()
            ];
        }

        return $response;
    }
}

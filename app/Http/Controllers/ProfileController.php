<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construc()
    {
    }

    public function updateProfileInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'             => 'required|string|max:15',
            'apellido'           => 'required|string|max:15',
            'cedula'             => 'required|string|max:8',
            'email'              => 'required|email|max:60',
            'password'           => 'nullable|string|min:8|max:20',
            'confirmar_password' => 'nullable|same:password'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if(!Auth::user()) {
            return response()->json(['res' => 'No hay un usuario en sesión'], 422);
        }

        $user = User::find(Auth::user()->id);

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->cedula = $request->cedula;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();


        return response()->json(['res' => 'La información de perfil fue actualizada.'], 200);
    }
}

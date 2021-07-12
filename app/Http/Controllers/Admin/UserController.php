<?php

namespace App\Http\Controllers\Admin;

use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * el modulo para la bitacora
     * 
     * @var
     * 
     */

     private $module = 'Usuarios';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.id','users.nombre', 'users.apellido', 'users.cedula',
                            'users.email','users.active' ,'users.email_verified_at','users.created_at',
                            'users.updated_at', 'roles.name as role_name', 'roles.id as role_id')
                    ->where('users.id', '!=', 1)
                    ->get();

        return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'   => 'required|string|max:40',
            'apellido' => 'required|string|max:40',
            'cedula'   => 'required|digits_between:6,10|unique:users',
            'email'    => 'required|string|max:60|unique:users',
            'clave'    => 'required|max:20|min:8',
            'role_id'  => 'required|max:1'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'password' => Hash::make($request->clave),
            'cedula'   => $request->cedula,
            'email'    => $request->email,
            'role_id'  => $request->role_id
        ]);

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado al usuario $user->nombre $user->apellido .",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Registro exitoso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['res' => 'No se ha podido encontrar el usuario seleccionado'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Búsqueda',
            'descripcion' => "El usuario ha solicitado la información del usuario $user->nombre $user->apellido.",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre'   => 'required|string|max:40',
            'apellido' => 'required|string|max:40',
            'cedula'   => 'digits_between:6,10|unique:users,cedula,' .$id,
            'email'    => 'string|max:60|unique:users,email,' .$id,
            'clave'    => 'nullable|max:20|min:8',
            'role_id'  => 'required|max:1'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($id);
        $old_nombre = $user->nombre;
        $old_apellido = $user->apellido;

        if (!$user) {
            return response()->json(['res' => 'No se ha podido encontrar el usuario seleccionado'], 404);
        }

        $user->nombre   = $request->nombre;
        $user->apellido = $request->apellido;
        $user->cedula   = $request->cedula ?? $user->cedula;
        $user->email    = $request->email ?? $user->email;
        $user->role_id  = $request->role_id;
        if ($request->clave) {
            $user->password = Hash::make($request->clave);
        }
        $user->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado la información del usuario $old_nombre $old_apellido a $user->nombre $user->apellido.",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Actualización completada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['res' => 'No se ha podido encontrar el usuario seleccionado'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado al usuario $user->nombre $user->apellido.",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $user->delete();

        return response()->json(['res' => 'Se ha eliminado el usuario']);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:1,0',
            'user_id' => 'required|integer'
        ]);

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['res' => 'usuario no existe'], 404);
        }
        $user->active = $request->status;
        $user->save();

        return response()->json(['res' => 'Se cambió el estado del usuario']);

    }
}

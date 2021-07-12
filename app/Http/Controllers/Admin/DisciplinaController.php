<?php

namespace App\Http\Controllers\Admin;

use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Disciplina;
use App\User;
use Illuminate\Support\Facades\Auth;

class DisciplinaController extends Controller
{
    /**
     * modulo para bitacora
     */

     private $module = 'Disciplinas';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disciplina::all();
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
            'nombre' => 'required|string|unique:disciplinas|max:40',
            'user_id' => 'required|numeric'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['res' => 'No existe el profesor seleccionado'], 422);
        }

        $disciplina = Disciplina::create(['nombre' => $request->nombre, 'user_id' => $request->user_id]);

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado una disciplina con el nombre: $disciplina->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Se ha registrado la disciplina']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disciplina = Disciplina::find($id);

        if (!$disciplina) {
            return response()->json(['res' => 'No se ha encontrado la disciplina seleccionada'], 404);
        }

        return $disciplina;
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
            'nombre' => 'string|max:40|unique:disciplinas,nombre,' .$id,
            'user_id' => 'required|numeric'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['res' => 'No existe el profesor seleccionado'], 404);
        }

        $disciplina = Disciplina::find($id);

        if (!$disciplina) {
            return response()->json(['res' => 'No se ha encontrado la disciplina seleccionada'], 404);
        }

        $old_nombre = $disciplina->nombre;
        $disciplina->nombre = $request->nombre ?? $disciplina->nombre;
        $disciplina->user_id = $request->user_id;
        $disciplina->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado la disciplina con el nombre $old_nombre a $disciplina->nombre",
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
        $disciplina = Disciplina::find($id);

        if (!$disciplina) {
            return response()->json(['res' => 'No se ha encontrado la disciplina seleccionada'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado la disciplina con el nombre: $disciplina->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $disciplina->delete();

        return response()->json(['res' => 'Se ha eliminado le disciplina']);
    }
}

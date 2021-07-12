<?php

namespace App\Http\Controllers\Admin;

use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Pnf;
use Illuminate\Support\Facades\Auth;

class PnfController extends Controller
{

    /**
     * modulo para bitacoras
     */

     private $module = 'PNF';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pnf::all();
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
            'nombre' => 'required|string|max:40|unique:pnfs'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pnf = Pnf::create(['nombre' => $request->nombre]);

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado un nuevo pnf con el nombre: $pnf->nombre",
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
    public function show($id)
    {
        $pnf = Pnf::find($id);

        if (!$pnf) {
            return response()->json(['res' => 'No se ha encontrado el pnf'], 404);
        }

        return $pnf;
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
            'nombre' => 'max:40|string|unique:pnfs,nombre,' .$id
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pnf = Pnf::where('id', $id)->first();
        $old_nombre = $pnf->nombre;

        if (!$pnf) {
            return response()->json(['res' => 'No existe el pnf'], 404);
        }

        $pnf->nombre = $request->nombre ?? $pnf->nombre;
        $pnf->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado el pnf $old_nombre y ahora es $pnf->nombre",
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
        $pnf = Pnf::where('id', $id)->first();
        if (!$pnf) {
            return response()->json(['res' => 'No existe el pnf'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado el pnf con el nombre: $pnf->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $pnf->delete();

        return response()->json(['res' => 'Se ha eliminado el pnf']);
    }
}

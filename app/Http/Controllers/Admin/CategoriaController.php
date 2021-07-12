<?php

namespace App\Http\Controllers\Admin;

use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * modulo para bitacora
     */

     private $module = 'Categorías';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categoria::all();
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
            'nombre'      => 'required|string|max:40|unique:categorias,nombre'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $categoria = Categoria::create([
            'nombre'      => $request->nombre
        ]);

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado una Categoría con el nombre: $categoria->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Se ha creado la categoría']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['res' => 'No existe la categoria seleccionada'], 404);
        }

        return $categoria;

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
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['res' => 'No existe la categoria seleccionada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'      => 'string|max:40|unique:categorias,nombre,' .$id
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $old_nombre = $categoria->nombre;
        $categoria->nombre = $request->nombre ?? $categoria->nombre;
        $categoria->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado una Categoría con el nombre: $old_nombre a $categoria->nombre",
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
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['res' => 'No existe la categoria seleccionada'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado la Categoría con el nombre: $categoria->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $categoria->delete();
        return response()->json(['res' => 'Se ha eliminado la categoría']);
    }
}

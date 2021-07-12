<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * el nombre del modulo para la bitacora
     * @var $module 
     */
    private $module = 'Eventos';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventos = DB::table('eventos')
            ->join('disciplinas', 'eventos.disciplina_id', '=', 'disciplinas.id')
            ->select('disciplinas.nombre as nombre_disciplina', 'eventos.*')
            ->get();
        return $eventos;
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
            'fecha'         => 'required|date',
            'descripcion'   => 'string|required|max:255',
            'disciplina_id' => 'digits:1|required',
            'categoria_id'  => 'digits:1|required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
       
        $evento = Evento::create($validator->valid());

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado un nuevo evento: $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Registro exitoso', 'inserted_id' => $evento->id]);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['res' => 'No existe el evento seleccionado'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Búsqueda',
            'descripcion' => "El usuario ha realizado una busqueda del evento $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return $evento;
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
            'fecha'         => 'required|date',
            'descripcion'   => 'string|required|max:255',
            'disciplina_id' => 'digits:1|required',
            'categoria_id'  => 'digits:1|required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['res' => 'No existe el evento seleccionado'], 404);
        }

        $evento->fecha         = $request->fecha;
        $evento->descripcion   = $request->descripcion;
        $evento->disciplina_id = $request->disciplina_id;
        $evento->categoria_id  = $request->categoria_id;

        $evento->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado la información del evento $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Actualización Exitosa']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['res' => 'No existe el evento seleccionado'], 404);
        }
        $evento->delete();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado al evento: $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Eliminación exitosa']);
    }
}
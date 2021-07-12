<?php

namespace App\Http\Controllers;

use App\Atleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\AtletasEventos;
use App\Bitacora;
use App\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AtletasEventosController extends Controller
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
    public function index()
    {
        return AtletasEventos::all();
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
            'atletas_id' => 'required|array',
            'eventos_id' => 'required|numeric'
        ], $this->errorMsgs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $evento = Evento::find($request->eventos_id);

        $atletas = $request->atletas_id;

        foreach ($atletas as $atleta) {
            $registros =  AtletasEventos::where([
                ['atletas_id', '=', $atleta],
                ['eventos_id', '=', $request->eventos_id]
            ])->get();

            if ($registros->count()) {
                return response()->json(['errors' => "El atleta con el id $atleta ya fue registrado en este evento"], 422);
            }
        }

        
        foreach ($atletas as $atleta) {
            AtletasEventos::create([
                'atletas_id' => $atleta,
                'eventos_id' => $request->eventos_id
            ]);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado atletas en el evento con la descripción: $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Registro Exitoso']);
    }

    /**
     * Mostrar todos los atletas de un evento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Evento::find($id);

        $evento = DB::table('eventos')
                    ->join('atleta_evento', 'eventos.id', '=', 'atleta_evento.eventos_id')
                    ->join('atletas', 'atletas.id', '=', 'atleta_evento.atletas_id')
                    ->select('atletas.id', 'atletas.nombre', 'atletas.apellido', 'atletas.cedula')
                    ->where('eventos.id', '=', $id)->get();

        if (!$evento->count()) {
            return response()->json([], 200);
        }
        return $evento;
    }

    public function eliminar(Request $request)
    {
        $result = AtletasEventos::where([
            ['atletas_id', '=', $request->atletas_id],
            ['eventos_id', '=', $request->eventos_id]
            ])->first();

        if (!$result) {
            return response()->json(['res' => 'El atleta no está registrado en ese evento'], 404);
        }

        $atleta = Atleta::find($request->atletas_id);
        $evento = Evento::find($request->eventos_id);

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado al atleta $atleta->nombre $atleta->apellido del evento $evento->descripcion",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $result->delete();


        return response()->json(['res' => 'El atleta fue eliminado del evento'], 200);
        
    }

    public function atletasNoRegistradosEnEvento(Request $request, $id)
    {
       $evento = Evento::find($id);

       if (!$evento) {
           return response()->json(['res' => 'El evento solicitado no existe'], 404);
       }

      $atletas = DB::table('atletas')
                    ->leftJoin('atleta_evento', 'atletas.id', '=', 'atleta_evento.atletas_id')
                    ->select('atletas.id', 'atletas.nombre', 'atletas.apellido', 
                            'atletas.correo', 'atletas.cedula', 'atletas.disciplina_id')
                    ->where('atletas.disciplina_id', '=', $evento->disciplina_id)
                    ->whereNull('atleta_evento.atletas_id')
                ->get();

        if(!$atletas->count()) {
                return response()->json([], 200);
        }
        return $atletas;
    }
}

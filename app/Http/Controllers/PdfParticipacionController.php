<?php

namespace App\Http\Controllers;

use App\Atleta;
use App\AtletasEventos;
use App\Bitacora;
use App\Evento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PdfParticipacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $evento_id, $atleta_id)
    {
        $evento = Evento::find($evento_id);

        if (!$evento) {
            return response()->json(['No se encontró el evento seleccionado', 404]);
        }

        $atleta = Atleta::find($atleta_id);

        if (!$atleta) {
            return response()->json(['No se encontró el atleta seleccionado', 404]);
        }

        $atleta_evento = AtletasEventos::where([
            ['atletas_id', '=',  $atleta_id],
            ['eventos_id', '=', $evento_id]
        ])->get();

        if (!$atleta_evento->count()) {
            return response()->json(['El atleta no está registrado en ese evento', 404]);
        }

        $admin = User::find(2);

        $data = [
            'nombre' => $atleta->nombre,
            'apellido' => $atleta->apellido,
            'cedula' => $atleta->cedula,
            'day_number' => date('d'),
            'month' => date('F'),
            'year' => date('Y'),
            'admin_nombre' => $admin->nombre,
            'admin_apellido' => $admin->apellido,
            'fecha_evento' => $evento->fecha,
            'descripcion_evento' => $evento->descripcion
        ];


        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Descarga',
            'descripcion' => "El usuario descargado una constacia de participacion del atleta $atleta->nombre $atleta->apellido al evento $evento->descripcion",
            'modulo' => 'Constancias',
            'direccion_ip' => $request->ip()
        ]);

        $pdf = \PDF::loadView('pdf.participacion', $data);
        return $pdf->download('participacion.pdf');

    }
}

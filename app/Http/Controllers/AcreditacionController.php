<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atleta;
use App\Bitacora;
use App\User;
use Illuminate\Support\Facades\Auth;

class AcreditacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {

        $atleta = Atleta::find($request->id);
        $admin = User::find(2);

        if (!$atleta) {
            return response()->json(['No se encontró el atleta seleccionado', 404]);
        }

        $data = [
            'nombre' => $atleta->nombre,
            'apellido' => $atleta->apellido,
            'cedula' => $atleta->cedula,
            'day_number' => date('d'),
            'month' => date('m'),
            'year' => date('Y'),
            'admin_nombre' => $admin->nombre,
            'admin_apellido' => $admin->apellido,
            'admin_cedula' => $admin->cedula
        ];

        $filename = "acreditacion-$atleta->nombre-$atleta->apellido";

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Descarga',
            'descripcion' => "El usuario descargado una constacia de acreditación del atleta $atleta->nombre $atleta->apellido",
            'modulo' => 'Constancias',
            'direccion_ip' => $request->ip()
        ]);
        
        $pdf = \PDF::loadView('pdf.acreditacion', $data);
        return $pdf->download($filename . '.pdf');
         
        
       
        
    }
}

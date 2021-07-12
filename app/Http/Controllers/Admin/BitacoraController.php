<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitacoras = DB::table('bitacoras')
        ->join('users', 'users.id', '=', 'bitacoras.user_id')
        ->select(
            'bitacoras.id',
            'bitacoras.accion',
            'bitacoras.descripcion',
            'bitacoras.modulo',
            'bitacoras.direccion_ip',
            'bitacoras.created_at as fecha',
            'users.nombre',
            'users.apellido',
            'users.cedula',
            'users.email'
        )->get();

        if (!$bitacoras->count() > 0) {
            return $bitacoras;
        }

        foreach ($bitacoras as $bitacora) {
            $bitacora->fecha = Carbon::parse($bitacora->fecha)->format('d-m-Y');
        }

        return $bitacoras;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bitacora = DB::table('bitacoras')
        ->where('bitacoras.id', '=', $id)
        ->join('users', 'users.id', '=', 'bitacoras.user_id')
        ->select('bitacoras.id', 'bitacoras.accion', 
                'bitacoras.descripcion', 'bitacoras.modulo',
                'bitacoras.direccion_ip',
                'users.nombre', 'users.apellido', 'users.cedula', 'users.email')->get();

        if (!$bitacora) {
            return response()->json(['res' => 'No existe la bitacora seleccionada'], 404);
        }

        return $bitacora;
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class AdminViewsController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    	return view('dashboard.index');
    }

    public function pnf()
    {
    	return view('dashboard.pnf');
    }

    public function lugares()
    {
    	return view('dashboard.lugares');
    }

    public function disciplinas()
    {
    	return view('dashboard.disciplinas')->with(['profesores' => User::all()]);
    }

    public function categorias()
    {
    	return view('dashboard.categorias');
    }

    public function usuarios()
    {
    	return view('dashboard.usuarios')->with(['roles' => Role::all()]);
    }

    public function constanciaAcreditacion()
    {
    	return view('dashboard.constancia-acreditacion');
    }

    public function constanciaParticipacion()
    {
    	return view('dashboard.constancia-participacion');
    }

    public function agregarAtletas($id_evento)
    {
        return view('dashboard.agregar_atletas',['id_evento' => $id_evento]);
    }

    public function bitacora($id)
    {
        $bitacora = DB::table('bitacoras')
        ->where('bitacoras.id', '=', $id)
        ->join('users', 'users.id', '=', 'bitacoras.user_id')
        ->select(
            'bitacoras.id',
            'bitacoras.accion',
            'bitacoras.descripcion',
            'bitacoras.modulo',
            'bitacoras.direccion_ip',
            'users.nombre',
            'users.apellido',
            'users.cedula',
            'users.email'
        )
        ->where('bitacoras.id', '=', $id)
        ->get();

        if (!$bitacora) {
            return response()->json(['res' => 'No existe la bitacora seleccionada'], 404);
        }

        return view('dashboard.bitacora_get', ['bitacora' => $bitacora]);  
    }

    public function bitacoras()
    {
        return view('dashboard.bitacora');
    }
    
}

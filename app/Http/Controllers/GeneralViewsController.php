<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Disciplina;
use App\Pnf;
use App\Categoria;

class GeneralViewsController extends Controller
{
	public function index()
	{
		return view('dashboard.index');
	}
    public function atletas()
    {
        if(! Auth::user()->isAdmin() ) {
            return view('profesor.atletas')->with([
                'disciplinas' => Disciplina::all(),
                'pnfs' => Pnf::all()
                ]);
        }

        return view('dashboard.atletas')->with([
            'disciplinas' => Disciplina::all(),
            'pnfs' => Pnf::all()
            ]);
    	
    }

    public function eventos()
    {
    	return view('dashboard.eventos')
        ->with([
            'disciplinas' => Disciplina::all(), 
            'categorias' => Categoria::all()
            ]);
    }

    public function perfil()
    {
        return view('shared.perfil');
    }
}

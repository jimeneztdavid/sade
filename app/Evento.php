<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{

	protected $fillable = [
		'fecha', 'descripcion', 'disciplina_id', 'categoria_id'
	];

    public function disciplina()
    {
    	return $this->belongsTo('App\Disciplina');
    }

    public function categoria()
    {
    	return $this->belongsTo('App\Categoria');
    }

    public function atletas() {
        return $this->belongsToMany('App\Atleta','atleta_evento', 'eventos_id', 'atletas_id');
    }
}

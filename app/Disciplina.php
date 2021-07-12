<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    /**
     * The attributes that are mass asignable
     *
     * @var array
     */
    protected  $fillable = [
    	'nombre', 'user_id'
    ];

    public function eventos()
    {
    	return $this->hasMany('App\Evento');
    }
}

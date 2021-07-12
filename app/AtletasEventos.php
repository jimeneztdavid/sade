<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtletasEventos extends Model
{
    protected $table = 'atleta_evento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'atletas_id', 'eventos_id'
    ];
}

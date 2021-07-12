<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Disciplina;

class DisciplinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplinas = [
        	['nombre' => 'Ajedrez', 'user_id' => 2],
        	['nombre' => 'Fútbol', 'user_id' => 2],
        	['nombre' => 'Baloncesto', 'user_id' => 2],
        	['nombre' => 'Natación', 'user_id' => 2],
        	['nombre' => 'Pin pon', 'user_id' => 2]
        ];

        foreach ($disciplinas as $disciplina) {
        	Disciplina::create($disciplina);
        }
    }
}

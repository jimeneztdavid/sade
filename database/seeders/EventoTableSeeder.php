<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventos = factory(\App\Evento::class, 20)->create();
    }
}

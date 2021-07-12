<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Pnf;

class PnfsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pnfs = [
        	['nombre' => 'Informática'],
        	['nombre' => 'Contaduría'],
        	['nombre' => 'Administración'],
        	['nombre' => 'Química'],
        	['nombre' => 'Instrumentación'],
        	['nombre' => 'Electricidad'],
        	['nombre' => 'Mecánica'],
        	['nombre' => 'Agropecuaria'],
        	['nombre' => 'Electrónica'],
        	['nombre' => 'Construcción Civil']
        ];

        foreach ($pnfs as $pnf) {
        	Pnf::create($pnf);
        }
    }
}

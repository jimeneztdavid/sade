<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$categorias = [
       		['nombre' => 'Top'],
       		['nombre' => 'Clasificatorio'],
       		['nombre' => 'Nacional'],
       		['nombre' => 'Amistoso'],
       	];

       	foreach ($categorias as $categoria) {
       		Categoria::create($categoria);
       	}
    }
}

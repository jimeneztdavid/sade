<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
        	UsersTableSeeder::class,
            PnfsTableSeeder::class,
            DisciplinasTableSeeder::class,
            CategoriasTableSeeder::class,
            AtletasTableSeeder::class,
            EventoTableSeeder::class
        ]);
    }
}

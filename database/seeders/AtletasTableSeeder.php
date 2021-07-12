<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AtletasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Atleta::class, 150)->create();
    }
}

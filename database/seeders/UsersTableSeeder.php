<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'No',
            'apellido' => 'asignado',
            'cedula' => '00000000',
            'email' => 'noasignado@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('profesor_noasignado_$%&/#$')
        ]);
        
        User::create([
        	'nombre' => 'admin',
            'apellido' => 'example',
            'cedula' => '00000001',
        	'email' => 'admin@example.com',
            'role_id' => 1,
        	'password' => Hash::make('admin')
        ]);

         User::create([
            'nombre' => 'profesor',
            'apellido' => 'example',
            'cedula' => '00000002',
            'email' => 'profesor@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('profesor')
        ]);

    }
}

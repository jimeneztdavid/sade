<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	['name' => 'admin'],
        	['name' => 'profesor']
        ];

        foreach ($roles as $role) {
        	Role::create($role);
        }
    }
}

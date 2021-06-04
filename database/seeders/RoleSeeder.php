<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nama' => 'Admin'],
            ['nama' => 'User'],
            ['nama' => 'Driver']
        ];

        Role::insert($roles);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Welson',
                'no_hp' => '082253129865',
                'email' => 'welson@eangkot.com',
                'password' => Hash::make('123'),
            ],
            [
                'nama' => 'Jon',
                'no_hp' => '081254468876',
                'email' => 'jon@eangkot.com',
                'password' => Hash::make('123'),
            ],
        ];

        User::insert($users);
        $welson = User::find(1);
        $jon = User::find(2);
        $welson->roles()->sync([1, 2, 3]);
        $jon->roles()->sync([2, 3]);
    }
}

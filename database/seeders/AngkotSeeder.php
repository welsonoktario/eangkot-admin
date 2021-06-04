<?php

namespace Database\Seeders;

use App\Models\Angkot;
use App\Models\Trayek;
use Illuminate\Database\Seeder;

class AngkotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trayek_c1 = Trayek::find(1);
        $trayek_c1->angkots()->saveMany([
            new Angkot(['no_kendaraan' => 'L 1111 CA']),
            new Angkot(['no_kendaraan' => 'L 1112 CB']),
        ]);

        $trayek_c2 = Trayek::find(2);
        $trayek_c2->angkots()->saveMany([
            new Angkot(['no_kendaraan' => 'L 2111 CC']),
            new Angkot(['no_kendaraan' => 'L 2112 CD']),
        ]);

        $trayek_e = Trayek::find(3);
        $trayek_e->angkots()->saveMany([
            new Angkot(['no_kendaraan' => 'L 3111 EA']),
            new Angkot(['no_kendaraan' => 'L 3112 EB']),
        ]);

        $trayek_k = Trayek::find(3);
        $trayek_k->angkots()->saveMany([
            new Angkot(['no_kendaraan' => 'L 4111 KA']),
            new Angkot(['no_kendaraan' => 'L 4112 KB']),
        ]);
    }
}

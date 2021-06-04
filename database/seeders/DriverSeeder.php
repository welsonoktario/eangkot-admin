<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = [
            [
                'user_id' => 2,
                'bank_id' => 1,
                'angkot_id' => 1,
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Keren No. 1',
                'rekening' => '7803463882'
            ]
        ];

        Driver::insert($drivers);
    }
}

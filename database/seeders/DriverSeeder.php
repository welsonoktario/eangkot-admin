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
        $driver = Driver::query()
            ->create([
                'user_id' => 2,
                'angkot_id' => 1,
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Keren No. 1',
            ]);

        $driver->rekenings()->sync([
            1 => ['rekening' => '7805308444']
        ]);
    }
}

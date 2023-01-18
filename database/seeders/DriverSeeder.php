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
        Driver::query()
            ->create([
                'user_id' => 2,
                'angkot_id' => 1,
                'trayek_id' => 7,
                'alamat' => 'Jl. Keren No. 1',
            ]);
    }
}

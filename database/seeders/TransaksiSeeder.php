<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pesanans = User::query()
            ->find(1)
            ->pesanans()
            ->createMany([
                [
                    'driver_id' => 1,
                    'jemput' => new Point(1, 1),
                    'tujuan' => new Point(1.1, 1.1),
                    'status' => 'Selesai'
                ],
                [
                    'driver_id' => 1,
                    'jemput' => new Point(2, 2),
                    'tujuan' => new Point(2.1, 2.1),
                ],
            ]);

        $pesanans[0]->transaksi()
            ->create([
                'ongkos' => 5000,
                'durasi_perjalanan' => 600,
                'jarak_perjalanan' => 2.3
            ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'kode' => '014',
                'nama' => 'Bank BCA'
            ],
            [
                'kode' => '114',
                'nama' => 'Bank Jatim'
            ],
        ];

        Bank::insert($banks);
    }
}

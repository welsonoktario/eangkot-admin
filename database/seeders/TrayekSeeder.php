<?php

namespace Database\Seeders;

use App\Models\Trayek;
use Illuminate\Database\Seeder;

class TrayekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trayeks = [
            [
                'kode' => 'C1',
                'rute' => 'Sedayu - Demak - Karang Menjangan (lewat Blauran)',
                'rute_berangkat' => 'Pangkalan Sedayu – Demak – Dupak – Bubutan (Sisi Utara) – Pasar Turi – Semarang – Stasiun Pasar Turi – Semarang – Kranggan – (D. Blauran) – Praban – Siola – Genteng Kali – Ngemplak – Ondomohen – Walikota Mustajab (Balaikota) – Jaksa Agung (Jagung) Suprapto – Ambengan – Kusuma Bangsa – Ngaglik – Tambaksari – Residen Sudirman – Pacar Keling – Kalasan – Jolotundo – Tambang Boyo – Karang Menjangan',
                'rute_pulang' => 'Karang Menjangan – Airlangga – Kedung Sroko – Pacar Keling – Residen Sudirman – Ambengan – Ngemplak – Genteng Kali – Praban – Bubutan – Pirngadi – Pawiyatan – Semarang – Dupak – Pasar Loak – Dupak – Demak – Purwodadi – Pangkalan Sedayu',
                'gambar' => 'https://www.surabaya.go.id/uploads/pictures/2017/2/25406/content_lyn_c-_semua.png'
            ],
            [
                'kode' => 'C2',
                'rute' => 'Sedayu -  Demak - Karang Menjangan (lewat Indrapura)',
                'rute_berangkat' => 'Pangkalan Sedayu – Demak Pasar Loak – Demak – Gresik Gadukan – Gresik – Rajawali – JMP – Veteran – Stasiun Kota – Pasar Atom – Gembong – Gembong Tebasan – Kapasari - Ngaglik – Tambaksari – Residen Sudirman – Pacar Keling – Kalasan – Jolotundo – Tambang Boyo – Karang Menjangan',
                'rute_pulang' => 'Karang Menjangan – Airlangga – Kedung Sroko – Pacar Keling – Residen Sudirman – Ambengan – Ngemplak – Genteng Kali – Praban – Bubutan – Pirngadi – Pawiyatan – Semarang – Dupak – Pasar Loak – Dupak – Demak – Purwodadi – Pangkalan Sedayu',
                'gambar' => 'https://www.surabaya.go.id/uploads/pictures/2017/2/25406/content_lyn_c-_semua.png'
            ],
            [
                'kode' => 'E',
                'rute' => 'Petojo(Karang Menjangan) – Balongsari',
                'rute_berangkat' => 'Pangkalan Dharma Husada – Prof Moestopo – Karang Menjangan – Airlangga – Prof Moestopo – Gubeng Pojok – Pemuda – Panglima Sudirman (Bambu Runcing) – Basuki Rahmat – Embong Malang – Tidar – Pasar Tidar – Tembok Sayuran – Kalibutuh – Asem Raya – Asem Mulya – Tambak Mayor – Tanjungsari – Tandes – Balongsari Tama – Balongsari',
                'rute_pulang' => 'Balongsari – Tandes – Tanjungsari – Tambak Mayor – Asem Mulya – Asem Raya – Kalibutuh – Tembok Sayuran – Tidar – Blauran – Praban – Siola – Genteng Kali – Ngemplak – Simpang Dukuh – Gubernur Suryo – Balai Pemuda – Yos Sudarso – Balai Kota – Prof Moestopo – Pangkalan Dharma Husada',
                'gambar' => 'https://www.surabaya.go.id/uploads/pictures/2017/2/25408/content_lyn_e-_semua.png'
            ],
            [
                'kode' => 'K',
                'rute' => 'Ujung Baru - Perak – JMP',
                'rute_berangkat' => 'Perak (Pelabuhan) – Kalimas Baru – Prapat Kurung – Perak Timur  - Rajawali – JMP – Jembatan Merah – Veteran – Pahlawan – Tugu Pahlawan – Bubutan (Sisi Utara) – Indrapura – Perak Barat – Prapat Kurung – Kalimas Baru – Perak (Pelabuhan)',
                'rute_pulang' => 'Kembali dengan rute yang sama',
                'gambar' => 'https://www.surabaya.go.id/uploads/pictures/2017/2/25418/content_lyn_k.png'
            ],
        ];

        Trayek::insert($trayeks);
    }
}

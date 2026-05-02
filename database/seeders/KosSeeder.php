<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    public function run()
    {
        $kos = [
            [
                'id_pemilik' => 1,
                'nama_kos' => 'Kos Gracia Putri',
                'alamat' => 'Jalan Merdeka No. 123, Jakarta Selatan',
                'kecamatan' => 'Kebayoran Baru',
                'kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => null,
                'latitude' => -6.20880000,
                'longitude' => 106.84560000,
                'deskripsi' => 'Kos nyaman dengan fasilitas lengkap dan lingkungan yang asri.',
                'peraturan' => null,
                'jenis_kos' => 'putri',
                'tipe_sewa' => 'bulanan',
                'foto_utama' => null,
                'status_kos' => 'aktif',
            ],
            [
                'id_pemilik' => 1,
                'nama_kos' => 'Kos Bahagia Putra',
                'alamat' => 'Jalan Sudirman No. 456, Jakarta Pusat',
                'kecamatan' => 'Tanah Abang',
                'kota' => 'Jakarta Pusat',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => null,
                'latitude' => -6.19090000,
                'longitude' => 106.82200000,
                'deskripsi' => 'Kos strategis dekat pusat kota dengan akses transportasi mudah.',
                'peraturan' => null,
                'jenis_kos' => 'putra',
                'tipe_sewa' => 'bulanan',
                'foto_utama' => null,
                'status_kos' => 'aktif',
            ],
        ];

        foreach ($kos as $data) {
            Kos::create($data);
        }
    }
}

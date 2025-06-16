<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('kriteria')->insert([
            [
                'kode_kriteria' => 'S1',
                'nama_kriteria' => 'Kategori',
                'nilai_ideal' => 5.00,
                'faktor_inti' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S2',
                'nama_kriteria' => 'Harga',
                'nilai_ideal' => 4.00,
                'faktor_inti' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S3',
                'nama_kriteria' => 'Rating',
                'nilai_ideal' => 5.00,
                'faktor_inti' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S4',
                'nama_kriteria' => 'Jumlah Viewers',
                'nilai_ideal' => 3.00,
                'faktor_inti' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S5',
                'nama_kriteria' => 'Bahasa',
                'nilai_ideal' => 3.00,
                'faktor_inti' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S6',
                'nama_kriteria' => 'Tipe Course',
                'nilai_ideal' => 3.00,
                'faktor_inti' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S7',
                'nama_kriteria' => 'Level',
                'nilai_ideal' => 3.00,
                'faktor_inti' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S8',
                'nama_kriteria' => 'Durasi',
                'nilai_ideal' => 3.00,
                'faktor_inti' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'S9',
                'nama_kriteria' => 'Situs / Platform Penyedia',
                'nilai_ideal' => 3.00,
                'faktor_inti' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

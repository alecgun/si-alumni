<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kuliah')->insert([
            [
                'alumni_id' => 1,
                'nama_universitas' => 'Universitas Indonesia',
                'fakultas' => 'Fakultas Teknik',
                'program_studi' => 'Teknik Informatika',
                'jenjang' => 'S1',
                'status_kuliah' => 'Aktif',
                'jalur_masuk' => 'SNMPTN',
                'tahun_masuk' => 2022,
                'tahun_lulus' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 1,
                'nama_universitas' => 'Universitas Brawijaya',
                'fakultas' => 'Fakultas Kedokteran',
                'program_studi' => 'Kedokteran Umum',
                'jenjang' => 'S2',
                'status_kuliah' => 'Aktif',
                'jalur_masuk' => 'Mandiri',
                'tahun_masuk' => 2024,
                'tahun_lulus' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 2,
                'nama_universitas' => 'Universitas Gadjah Mada',
                'fakultas' => 'Fakultas Pendidikan',
                'program_studi' => 'Pendidikan Bahasa Inggris',
                'jenjang' => 'S1',
                'status_kuliah' => 'Lulus',
                'jalur_masuk' => 'SBMPTN',
                'tahun_masuk' => 2021,
                'tahun_lulus' => 2025,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

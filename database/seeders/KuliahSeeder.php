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
                'jenjang' => 'S1',
                'jalur_masuk' => 'SNMPTN',
                'tahun_masuk' => 2022,
                'tahun_lulus' => 2026,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 1,
                'nama_universitas' => 'Universitas Brawijaya',
                'jenjang' => 'S2',
                'jalur_masuk' => 'Mandiri',
                'tahun_masuk' => 2026,
                'tahun_lulus' => 2027,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 2,
                'nama_universitas' => 'Universitas Gadjah Mada',
                'jenjang' => 'S1',
                'jalur_masuk' => 'SBMPTN',
                'tahun_masuk' => 2021,
                'tahun_lulus' => 2025,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

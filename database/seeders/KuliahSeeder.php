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
                'jenjang' => 'S1',
                'jalur_masuk' => 'SNMPTN',
                'tahun_masuk' => 2022,
                'tahun_lulus' => 2026,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 2,
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

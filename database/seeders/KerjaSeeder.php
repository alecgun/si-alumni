<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kerja')->insert([
            [
                'alumni_id' => 1,
                'posisi_kerja' => 'Software Developer',
                'tempat_kerja' => 'Tech Company A',
                'tahun_masuk' => 2026,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'alumni_id' => 2,
                'posisi_kerja' => 'Marketing Executive',
                'tempat_kerja' => 'Marketing Firm B',
                'tahun_masuk' => 2025,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

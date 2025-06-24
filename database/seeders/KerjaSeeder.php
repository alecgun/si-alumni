<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class KerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumni1 = DB::table('alumni')->where('nama', 'John Doe')->first();
        $alumni2 = DB::table('alumni')->where('nama', 'Jane Smith')->first();
        DB::table('kerja')->insert([
            [
                'id' =>  Str::uuid(),
                'alumni_id' => $alumni1->id,
                'posisi_kerja' => 'Software Developer',
                'tempat_kerja' => 'Tech Company A',
                'alamat_kerja' => 'Jakarta Selatan',
                'tahun_masuk' => 2026,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'alumni_id' => $alumni2->id,
                'posisi_kerja' => 'Marketing Executive',
                'tempat_kerja' => 'Marketing Firm B',
                'alamat_kerja' => 'Jakarta Utara',
                'tahun_masuk' => 2025,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

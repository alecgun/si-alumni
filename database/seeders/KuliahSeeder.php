<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class KuliahSeeder extends Seeder
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
        DB::table('kuliah')->insert([
            [
                'id' =>  Str::uuid(),
                'alumni_id' => $alumni1->id,
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
                'id' =>  Str::uuid(),
                'alumni_id' => $alumni1->id,
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
                'id' =>  Str::uuid(),
                'alumni_id' => $alumni2->id,
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

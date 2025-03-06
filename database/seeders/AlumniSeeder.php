<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumnis = [
            [
                'nis' => '123456',
                'nama' => 'John Doe',
                'kelas' => 'XII IPA 1',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'instagram' => '@johndoe',
                'sosmed_lain' => 'https://twitter.com/johndoe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '789012',
                'nama' => 'Jane Smith',
                'kelas' => 'XII IPS 2',
                'tahun_masuk' => 2018,
                'tahun_lulus' => 2021,
                'instagram' => '@janesmith',
                'sosmed_lain' => 'https://facebook.com/janesmith',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($alumnis as $alumni) {
            Alumni::create($alumni);
        }
    }
}

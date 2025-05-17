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

        $userJohn = DB::table('users')->where('name', 'John Doe')->first();
        $userJane = DB::table('users')->where('name', 'Jane Smith')->first();
        $userMichael = DB::table('users')->where('name', 'Michael Johnson')->first();
        $userEmily = DB::table('users')->where('name', 'Emily Davis')->first();
        $userDavid = DB::table('users')->where('name', 'David Brown')->first();

        $alumnis = [
            [
                'nis' => '123456',
                'nama' => 'John Doe',
                'kelas' => 'XII IPA 1',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '1999-01-01',
                'instagram' => '@johndoe',
                'sosmed_lain' => 'https://twitter.com/johndoe',
                'id_user' => $userJohn->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '789012',
                'nama' => 'Jane Smith',
                'kelas' => 'XII IPS 2',
                'tahun_masuk' => 2018,
                'tahun_lulus' => 2021,
                'tanggal_lahir' => '2000-02-02',
                'instagram' => '@janesmith',
                'sosmed_lain' => 'https://facebook.com/janesmith',
                'id_user' => $userJane->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '345678',
                'nama' => 'Michael Johnson',
                'kelas' => 'XII IPS 3',
                'tahun_masuk' => 2017,
                'tahun_lulus' => 2020,
                'tanggal_lahir' => '1998-03-03',
                'instagram' => '@michaeljohnson',
                'sosmed_lain' => 'https://instagram.com/michaeljohnson',
                'id_user' => $userMichael->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '901234',
                'nama' => 'Emily Davis',
                'kelas' => 'XII IPA 4',
                'tahun_masuk' => 2016,
                'tahun_lulus' => 2019,
                'tanggal_lahir' => '1997-04-04',
                'instagram' => '@emilydavis',
                'sosmed_lain' => 'https://twitter.com/emilydavis',
                'id_user' => $userEmily->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nis' => '567890',
                'nama' => 'David Brown',
                'kelas' => 'XII IPA 5',
                'tahun_masuk' => 2015,
                'tahun_lulus' => 2018,
                'tanggal_lahir' => '1996-05-05',
                'instagram' => '@davidbrown',
                'sosmed_lain' => 'https://facebook.com/davidbrown',
                'id_user' => $userDavid->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($alumnis as $alumni) {
            Alumni::create($alumni);
        }
    }
}

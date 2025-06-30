<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $userMbujo = DB::table('users')->where('name', 'M. Buriram Jordan')->first();
        $userMicburiram = DB::table('users')->where('name', 'Michael Buriram Jordan')->first();
        $userMBJordan = DB::table('users')->where('name', 'Michael B. Jordan')->first();
        $userSophia = DB::table('users')->where('name', 'Sophia Williams')->first();
        $userEthan = DB::table('users')->where('name', 'Ethan Thomas')->first();
        $userOlivia = DB::table('users')->where('name', 'Olivia Martinez')->first();
        $userAva = DB::table('users')->where('name', 'Ava White')->first();
        $userJames = DB::table('users')->where('name', 'James Harris')->first();
        $userIsabella = DB::table('users')->where('name', 'Isabella Clark')->first();
        $userLiam = DB::table('users')->where('name', 'Liam Lewis')->first();
        $userMia = DB::table('users')->where('name', 'Mia Walker')->first();
        $userNoah = DB::table('users')->where('name', 'Noah Hall')->first();
        $userLucas = DB::table('users')->where('name', 'Lucas Young')->first();

        $alumnis = [
            [
                'id' =>  Str::uuid(),
                'nis' => '12245',
                'nama' => 'John Doe',
                'kelas' => 'XII IPA 1',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '1999-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'johndoe',
                'sosmed_lain' => 'https://twitter.com/johndoe',
                'id_user' => $userJohn->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '78375',
                'nama' => 'Jane Smith',
                'kelas' => 'XII IPS 2',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '2000-02-02',
                'jenis_kelamin' => 'Perempuan',
                'instagram' => 'janesmith',
                'sosmed_lain' => 'https://facebook.com/janesmith',
                'id_user' => $userJane->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '34527',
                'nama' => 'Michael Johnson',
                'kelas' => 'XII IPS 3',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '1998-03-03',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'michaeljohnson',
                'sosmed_lain' => 'https://instagram.com/michaeljohnson',
                'id_user' => $userMichael->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '90123',
                'nama' => 'Emily Davis',
                'kelas' => 'XII IPA 4',
                'tahun_masuk' => 2018,
                'tahun_lulus' => 2021,
                'tanggal_lahir' => '1997-04-04',
                'jenis_kelamin' => 'Perempuan',
                'instagram' => 'emilydavis',
                'sosmed_lain' => 'https://twitter.com/emilydavis',
                'id_user' => $userEmily->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '56781',
                'nama' => 'David Brown',
                'kelas' => 'XII IPA 5',
                'tahun_masuk' => 2018,
                'tahun_lulus' => 2021,
                'tanggal_lahir' => '1996-05-05',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'davidbrown',
                'sosmed_lain' => 'https://facebook.com/davidbrown',
                'id_user' => $userDavid->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '23456',
                'nama' => 'M. Buriram Jordan',
                'kelas' => 'XII IPS 6',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '1995-06-06',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'mburiramjordan',
                'sosmed_lain' => 'https://instagram.com/mburiramjordan',
                'id_user' => $userMbujo->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '34563',
                'nama' => 'Michael Buriram Jordan',
                'kelas' => 'XII IPA 7',
                'tahun_masuk' => 2017,
                'tahun_lulus' => 2020,
                'tanggal_lahir' => '1994-07-07',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'michaelburiramjordan',
                'sosmed_lain' => 'https://twitter.com/michaelburiramjordan',
                'id_user' => $userMicburiram->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '45678',
                'nama' => 'Michael B. Jordan',
                'kelas' => 'XII IPS 8',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2022,
                'tanggal_lahir' => '1993-08-08',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'michaelbjordan',
                'sosmed_lain' => null,
                'id_user' => $userMBJordan->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '56784',
                'nama' => 'Sophia Williams',
                'kelas' => 'XII IPA 9',
                'tahun_masuk' => 2020,
                'tahun_lulus' => 2023,
                'tanggal_lahir' => '1992-09-09',
                'jenis_kelamin' => 'Perempuan',
                'instagram' => 'sophiawilliams',
                'sosmed_lain' => 'https://facebook.com/sophiawilliams',
                'id_user' => $userSophia->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '34353',
                'nama' => 'Ethan Thomas',
                'kelas' => 'XII IPA 9',
                'tahun_masuk' => 2020,
                'tahun_lulus' => 2023,
                'tanggal_lahir' => '1994-10-10',
                'jenis_kelamin' => 'Laki-laki',
                'instagram' => 'ethan_thomas',
                'sosmed_lain' => 'https://facebook.com/ethan_thomas',
                'id_user' => $userEthan->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>  Str::uuid(),
                'nis' => '34352',
                'nama' => 'Olivia Martinez',
                'kelas' => 'XII IPA 6',
                'tahun_masuk' => 2021,
                'tahun_lulus' => 2024,
                'tanggal_lahir' => '2005-11-11',
                'jenis_kelamin' => 'Perempuan',
                'instagram' => 'oli_martinez',
                'sosmed_lain' => 'https://facebook.com/oli_martinez',
                'id_user' => $userOlivia->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($alumnis as $alumni) {
            Alumni::create($alumni);
        }
    }
}

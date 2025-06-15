<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengumuman')->insert([
            [
                'foto' => 'pengumuman/blog-01.jpg',
                'judul' => 'Nantikan Event Job Fair Blitar 2025!',
                'isi' => 'Kami mengundang seluruh alumni untuk hadir di Job Fair yang akan diadakan pada tanggal 15 Maret 2025 di Gedung Serbaguna Blitar. Banyak perusahaan ternama yang akan membuka lowongan kerja.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'foto' => 'pengumuman/blog-02.jpg',
                'judul' => 'Reuni Akbar Alumni SMAN 1 Blitar Akan Segera Hadir!',
                'isi' => 'Kami mengundang seluruh alumni SMAN 1 Blitar untuk hadir dalam reuni akbar yang akan diadakan pada tanggal 20 April 2025. Acara ini akan menjadi kesempatan emas untuk bertemu kembali dengan teman-teman lama.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

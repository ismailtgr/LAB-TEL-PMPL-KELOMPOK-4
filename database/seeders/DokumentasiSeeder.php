<?php

namespace Database\Seeders;

use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = Kegiatan::first();

        Dokumentasi::create([
            'kegiatan_id' => $kegiatan->id,
            'file_path' => 'dummy/dokumentasi1.jpg',
            'caption' => 'Peserta workshop sedang praktik.',
        ]);

        Dokumentasi::create([
            'kegiatan_id' => $kegiatan->id,
            'file_path' => 'dummy/dokumentasi2.jpg',
            'caption' => 'Sesi pemaparan materi embedded system.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use App\Models\User;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->first();

        if (!$mahasiswa) {
            return;
        }

        Kegiatan::create([
            'judul' => 'Workshop Embedded System',
            'deskripsi' => 'Workshop mengenai dasar embedded system menggunakan ESP32.',
            'tanggal' => '2026-05-10',
            'waktu_mulai' => '08:00:00',
            'waktu_selesai' => '12:00:00',
            'lokasi' => 'Laboratorium TEL FILKOM UB',
            'status' => 'pending',
            'kategori' => 'Workshop',
            'created_by' => $mahasiswa->id,
        ]);

        Kegiatan::create([
            'judul' => 'Pelatihan IoT Dasar',
            'deskripsi' => 'Pelatihan Internet of Things untuk mahasiswa baru.',
            'tanggal' => '2026-05-12',
            'waktu_mulai' => '09:00:00',
            'waktu_selesai' => '13:00:00',
            'lokasi' => 'Gedung F FILKOM',
            'status' => 'disetujui',
            'kategori' => 'Pelatihan',
            'created_by' => $mahasiswa->id,
        ]);

        Kegiatan::create([
            'judul' => 'Seminar AI',
            'deskripsi' => 'Seminar pengenalan Artificial Intelligence di laboratorium.',
            'tanggal' => '2026-05-15',
            'waktu_mulai' => '10:00:00',
            'waktu_selesai' => '14:00:00',
            'lokasi' => 'Aula FILKOM',
            'status' => 'ditolak',
            'kategori' => 'Seminar',
            'created_by' => $mahasiswa->id,
        ]);
    }
}

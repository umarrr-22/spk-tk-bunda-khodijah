<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat akun admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Data dummy siswa
        $siswas = [
            [
                'nama' => 'Ananda Putri',
                'usia' => 5,
                'kelas' => 'TK A',
                'jenis_kelamin' => 'Perempuan',
                'kegiatan' => 'Tanaman',
                'kebutuhan_khusus' => null
            ],
            [
                'nama' => 'Budi Santoso',
                'usia' => 6,
                'kelas' => 'TK B',
                'jenis_kelamin' => 'Laki-laki',
                'kegiatan' => 'Wisata lokal edukasi',
                'kebutuhan_khusus' => null
            ],
            [
                'nama' => 'Citra Dewi',
                'usia' => 4,
                'kelas' => 'TK A',
                'jenis_kelamin' => 'Perempuan',
                'kegiatan' => 'Berkeliling dengan kereta kelinci',
                'kebutuhan_khusus' => null
            ],
            [
                'nama' => 'Dito Pratama',
                'usia' => 5,
                'kelas' => 'TK B',
                'jenis_kelamin' => 'Laki-laki',
                'kegiatan' => 'Praktek pembuatan lumpia',
                'kebutuhan_khusus' => 'Perlu pendampingan khusus'
            ]
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }

        // 3. Program Seeder
        $programs = [
            [
                'nama' => 'Tanaman',
                'deskripsi' => 'Kegiatan mengenal berbagai jenis tanaman dan cara merawatnya'
            ],
            [
                'nama' => 'Wisata lokal edukasi',
                'deskripsi' => 'Kunjungan ke tempat-tempat wisata dengan nilai edukasi'
            ],
            [
                'nama' => 'Mengamati tempat produksi UMKM lumpia',
                'deskripsi' => 'Mengamati proses produksi lumpia di UMKM lokal'
            ],
            [
                'nama' => 'Praktek pembuatan lumpia',
                'deskripsi' => 'Praktek langsung membuat lumpia dengan bimbingan'
            ],
            [
                'nama' => 'Cita-citaku',
                'deskripsi' => 'Kegiatan mengenal berbagai profesi dan cita-cita'
            ],
            [
                'nama' => 'Ibadah di bulan Ramadhan',
                'deskripsi' => 'Memberikan informasi tentang ibadah khusus di bulan Ramadhan'
            ],
            [
                'nama' => 'Berkeliling dengan kereta kelinci',
                'deskripsi' => 'Berkeliling lingkungan sekolah dan masjid menggunakan kereta kelinci'
            ]
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }

        // 4. Kriteria Seeder
        $kriterias = [
            ['nama' => 'Minat Siswa', 'bobot' => 0.3],
            ['nama' => 'Kesesuaian Usia', 'bobot' => 0.25],
            ['nama' => 'Kemampuan Motorik', 'bobot' => 0.2],
            ['nama' => 'Nilai Edukasi', 'bobot' => 0.15],
            ['nama' => 'Ketersediaan Fasilitas', 'bobot' => 0.1]
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }

        // 5. Data Nilai Contoh
        $nilais = [
            // Ananda Putri (usia 5)
            ['siswa_id' => 1, 'program_id' => 1, 'kriteria_id' => 1, 'nilai' => 4], // Tanaman - Minat
            ['siswa_id' => 1, 'program_id' => 1, 'kriteria_id' => 2, 'nilai' => 5], // Tanaman - Usia
            ['siswa_id' => 1, 'program_id' => 1, 'kriteria_id' => 3, 'nilai' => 3], // Tanaman - Motorik
            
            // Budi Santoso (usia 6)
            ['siswa_id' => 2, 'program_id' => 4, 'kriteria_id' => 1, 'nilai' => 5], // Praktek lumpia - Minat
            ['siswa_id' => 2, 'program_id' => 4, 'kriteria_id' => 2, 'nilai' => 5], // Praktek lumpia - Usia
            
            // Citra Dewi (usia 4)
            ['siswa_id' => 3, 'program_id' => 7, 'kriteria_id' => 1, 'nilai' => 5], // Kereta kelinci - Minat
            ['siswa_id' => 3, 'program_id' => 7, 'kriteria_id' => 3, 'nilai' => 4], // Kereta kelinci - Motorik
            
            // Dito Pratama (usia 5)
            ['siswa_id' => 4, 'program_id' => 3, 'kriteria_id' => 1, 'nilai' => 4], // Mengamati UMKM - Minat
            ['siswa_id' => 4, 'program_id' => 3, 'kriteria_id' => 4, 'nilai' => 3], // Mengamati UMKM - Edukasi
        ];

        foreach ($nilais as $nilai) {
            Nilai::create($nilai);
        }
    }
}
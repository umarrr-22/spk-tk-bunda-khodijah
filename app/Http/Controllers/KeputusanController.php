<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Program;
use App\Models\Kriteria;
use App\Models\Nilai;

class KeputusanController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('nilais')->get();
        return view('keputusan.index', compact('siswas'));
    }

    public function show(Siswa $siswa)
    {
        $programs = Program::all();
        $kriterias = Kriteria::all();
        $nilais = $siswa->nilais()->with(['program', 'kriteria'])->get();
        
        return view('keputusan.show', compact('siswa', 'programs', 'kriterias', 'nilais'));
    }

    public function hasil(Siswa $siswa)
    {
        $programs = Program::all();
        $kriterias = Kriteria::all();
        $results = [];

        foreach ($programs as $program) {
            $total = 0;
            $details = [];
            
            foreach ($kriterias as $kriteria) {
                $nilai = Nilai::where('siswa_id', $siswa->id)
                            ->where('program_id', $program->id)
                            ->where('kriteria_id', $kriteria->id)
                            ->first();
                
                if ($nilai) {
                    $normalized = $nilai->nilai / 5;
                    
                    if ($kriteria->nama == 'Kesesuaian Usia') {
                        $normalized = $this->calculateAgeCompatibility($siswa->usia, $program->id);
                    }
                    
                    $weighted = $normalized * $kriteria->bobot;
                    
                    $details[] = [
                        'kriteria' => $kriteria->nama,
                        'nilai' => $nilai->nilai,
                        'normalized' => $normalized,
                        'bobot' => $kriteria->bobot,
                        'weighted' => $weighted
                    ];
                    
                    $total += $weighted;
                }
            }
            
            if (count($details) > 0) {
                $results[] = [
                    'program' => $program,
                    'total' => $total,
                    'details' => $details,
                    'age_compatibility' => $this->calculateAgeCompatibility($siswa->usia, $program->id)
                ];
            }
        }

        usort($results, fn($a, $b) => $b['total'] <=> $a['total']);

        return view('keputusan.hasil', compact('siswa', 'results'));
    }

    private function calculateAgeCompatibility($usia, $programId)
    {
        return match($programId) {
            1 => $usia >= 4 ? 0.9 : ($usia >= 3 ? 0.7 : 0.4),    // Tanaman
            2 => $usia >= 5 ? 1.0 : ($usia >= 4 ? 0.6 : 0.3),    // Wisata edukasi
            3 => $usia >= 5 ? 0.8 : ($usia >= 4 ? 0.5 : 0.2),    // Mengamati UMKM
            4 => $usia >= 6 ? 1.0 : ($usia >= 5 ? 0.7 : 0.3),    // Praktek lumpia
            5 => $usia >= 5 ? 0.9 : ($usia >= 4 ? 0.6 : 0.4),    // Cita-citaku
            6 => $usia >= 4 ? 0.8 : ($usia >= 3 ? 0.5 : 0.3),    // Ibadah Ramadhan
            7 => $usia >= 3 ? 1.0 : 0.2,                         // Kereta kelinci
            default => 0.5
        };
    }
}
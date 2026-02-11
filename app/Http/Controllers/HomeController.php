<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Program;
use App\Models\Kriteria;
use App\Models\Nilai;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'siswaCount' => Siswa::count(),
            'programCount' => Program::count(),
            'kriteriaCount' => Kriteria::count(),
            'recentSiswas' => Siswa::latest()->take(5)->get(),
            'recentKeputusan' => Siswa::has('nilais')
                ->with(['nilais' => function($query) {
                    $query->orderBy('updated_at', 'desc');
                }])
                ->latest()
                ->take(5)
                ->get()
                ->map(function($siswa) {
                    $siswa->rekomendasi_program = optional($siswa->nilais->first())->program->nama ?? null;
                    return $siswa;
                })
        ];

        return view('home', $data);
    }
}
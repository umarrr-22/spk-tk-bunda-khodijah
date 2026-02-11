<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa', 'program', 'kriteria'])->paginate(10);
        return view('nilais.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $programs = Program::all();
        $kriterias = Kriteria::all();
        
        return view('nilais.create', compact('siswas', 'programs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'program_id' => 'required|exists:programs,id',
            'kriteria_id' => 'required|exists:kriterias,id',
            'nilai' => 'required|integer|min:1|max:5'
        ]);

        if (Nilai::where($request->only(['siswa_id', 'program_id', 'kriteria_id']))->exists()) {
            return back()->with('error', 'Data nilai sudah ada untuk kombinasi ini');
        }

        Nilai::create($validated);

        return redirect()->route('nilais.index')
                        ->with('success', 'Nilai berhasil ditambahkan');
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::all();
        $programs = Program::all();
        $kriterias = Kriteria::all();
        
        return view('nilais.edit', compact('nilai', 'siswas', 'programs', 'kriterias'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $validated = $request->validate([
            'nilai' => 'required|integer|min:1|max:5'
        ]);

        $nilai->update($validated);

        return redirect()->route('nilais.index')
                        ->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilais.index')
                        ->with('success', 'Nilai berhasil dihapus');
    }

    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nilai' => 'required|array',
            'nilai.*.*' => 'required|integer|min:1|max:5'
        ]);

        foreach ($request->nilai as $programId => $kriteriaValues) {
            foreach ($kriteriaValues as $kriteriaId => $nilai) {
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $request->siswa_id,
                        'program_id' => $programId,
                        'kriteria_id' => $kriteriaId
                    ],
                    ['nilai' => $nilai]
                );
            }
        }

        return redirect()->route('keputusan.hasil', $request->siswa_id)
                        ->with('success', 'Nilai berhasil disimpan');
    }
}
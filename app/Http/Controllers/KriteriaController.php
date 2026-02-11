<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $totalBobot = Kriteria::sum('bobot');
        
        return view('kriterias.index', compact('kriterias', 'totalBobot'));
    }

    public function create()
    {
        return view('kriterias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kriterias',
            'bobot' => 'required|numeric|min:0.01|max:1'
        ]);

        DB::transaction(function () use ($validated) {
            Kriteria::create($validated);
            $this->normalizeBobot();
        });

        return redirect()->route('kriterias.index')
                        ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriterias.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kriterias,nama,'.$kriteria->id,
            'bobot' => 'required|numeric|min:0.01|max:1'
        ]);

        DB::transaction(function () use ($kriteria, $validated) {
            $kriteria->update($validated);
            $this->normalizeBobot();
        });

        return redirect()->route('kriterias.index')
                        ->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        $this->normalizeBobot();

        return redirect()->route('kriterias.index')
                        ->with('success', 'Kriteria berhasil dihapus');
    }

    private function normalizeBobot()
    {
        $total = Kriteria::sum('bobot');
        if ($total != 1) {
            $kriterias = Kriteria::all();
            foreach ($kriterias as $kriteria) {
                $kriteria->update(['bobot' => $kriteria->bobot / $total]);
            }
        }
    }
}
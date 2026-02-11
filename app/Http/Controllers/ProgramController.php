<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::paginate(10);
        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:programs',
            'deskripsi' => 'required|string'
        ]);

        Program::create($validated);

        return redirect()->route('programs.index')
                        ->with('success', 'Program berhasil ditambahkan');
    }

    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:programs,nama,'.$program->id,
            'deskripsi' => 'required|string'
        ]);

        $program->update($validated);

        return redirect()->route('programs.index')
                        ->with('success', 'Program berhasil diperbarui');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
                        ->with('success', 'Program berhasil dihapus');
    }
}
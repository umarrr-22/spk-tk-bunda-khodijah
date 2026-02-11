<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);
        return view('siswas.index', compact('siswas'));
    }

    public function create()
    {
        $kegiatanOptions = $this->getKegiatanOptions();
        return view('siswas.create', compact('kegiatanOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer|min:3|max:6',
            'kelas' => 'required|in:TK A,TK B',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kegiatan' => 'required|string|max:255',
            'kebutuhan_khusus' => 'nullable|string|max:255'
        ]);

        Siswa::create($validated);

        return redirect()->route('siswas.index')
                       ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('nilais.program', 'nilais.kriteria');
        return view('siswas.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kegiatanOptions = $this->getKegiatanOptions();
        return view('siswas.edit', compact('siswa', 'kegiatanOptions'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer|min:3|max:6',
            'kelas' => 'required|in:TK A,TK B',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kegiatan' => 'required|string|max:255',
            'kebutuhan_khusus' => 'nullable|string|max:255'
        ]);

        $siswa->update($validated);

        return redirect()->route('siswas.index')
                       ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        // Delete related nilai records first
        Nilai::where('siswa_id', $siswa->id)->delete();
        
        $siswa->delete();

        return redirect()->route('siswas.index')
                       ->with('success', 'Data siswa berhasil dihapus');
    }

    protected function getKegiatanOptions()
    {
        return [
            'Tanaman',
            'Wisata lokal edukasi',
            'Mengamati tempat produksi UMKM lumpia',
            'Praktek pembuatan lumpia',
            'Cita-citaku',
            'Ibadah di bulan Ramadhan',
            'Berkeliling dengan kereta kelinci'
        ];
    }
}
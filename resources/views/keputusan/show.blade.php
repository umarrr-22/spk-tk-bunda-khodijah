@extends('layouts.app')

@section('title', 'Input Nilai - Rekomendasi Program')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Input Nilai untuk {{ $siswa->nama }}</h4>
            <a href="{{ route('keputusan.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Profil Siswa</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Nama</th>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Usia</th>
                        <td>{{ $siswa->usia }} tahun</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $siswa->kelas }}</td>
                    </tr>
                    <tr>
                        <th>Kebutuhan Khusus</th>
                        <td>{{ $siswa->kebutuhan_khusus ?: 'Tidak ada' }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h5>Petunjuk Penilaian</h5>
                <div class="alert alert-info">
                    <strong>Skala Nilai 1-5:</strong>
                    <ul class="mb-0">
                        <li>1 = Sangat Tidak Sesuai</li>
                        <li>2 = Tidak Sesuai</li>
                        <li>3 = Cukup Sesuai</li>
                        <li>4 = Sesuai</li>
                        <li>5 = Sangat Sesuai</li>
                    </ul>
                </div>
            </div>
        </div>

        <form action="{{ route('nilais.store-multiple') }}" method="POST">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            
            <h4 class="mb-3">Penilaian Program</h4>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Program</th>
                            @foreach($kriterias as $kriteria)
                            <th>{{ $kriteria->nama }} (Bobot: {{ $kriteria->bobot }})</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                        <tr>
                            <td>
                                <strong>{{ $program->nama }}</strong>
                                <div class="small text-muted">{{ Str::limit($program->deskripsi, 50) }}</div>
                            </td>
                            @foreach($kriterias as $kriteria)
                            <td>
                                @php
                                    $existingNilai = $nilais->where('program_id', $program->id)
                                        ->where('kriteria_id', $kriteria->id)
                                        ->first();
                                @endphp
                                <select name="nilai[{{ $program->id }}][{{ $kriteria->id }}]" 
                                        class="form-control form-control-sm">
                                    <option value="">Pilih Nilai</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}"
                                            {{ $existingNilai && $existingNilai->nilai == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Nilai
                </button>
                @if($siswa->nilais()->exists())
                    <a href="{{ route('keputusan.hasil', $siswa->id) }}" class="btn btn-success">
                        <i class="bi bi-graph-up"></i> Lihat Rekomendasi
                    </a>
                @endif
                <a href="{{ route('keputusan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5>Detail Data Siswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <p class="form-control-plaintext">{{ $siswa->nama }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <p class="form-control-plaintext">{{ $siswa->usia }} tahun</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <p class="form-control-plaintext">{{ $siswa->kelas }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <p class="form-control-plaintext">{{ $siswa->jenis_kelamin }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kegiatan Saat Ini</label>
                    <p class="form-control-plaintext">{{ $siswa->kegiatan }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kebutuhan Khusus</label>
                    <p class="form-control-plaintext">{{ $siswa->kebutuhan_khusus ?: 'Tidak ada' }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('siswas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>
</div>

<!-- Rekomendasi Section -->
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h5>Rekomendasi Program</h5>
    </div>
    <div class="card-body">
        @if($siswa->nilais->count() > 0)
            <div class="alert alert-info">
                <a href="{{ route('keputusan.hasil', $siswa->id) }}" class="btn btn-success">
                    <i class="bi bi-graph-up"></i> Lihat Rekomendasi
                </a>
                <span class="ms-2">Data penilaian sudah tersedia untuk siswa ini.</span>
            </div>
        @else
            <div class="alert alert-warning">
                <a href="{{ route('keputusan.show', $siswa->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Input Nilai
                </a>
                <span class="ms-2">Belum ada data penilaian untuk siswa ini.</span>
            </div>
        @endif
    </div>
</div>
@endsection
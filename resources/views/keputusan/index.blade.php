@extends('layouts.app')

@section('title', 'Rekomendasi Program')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Siswa untuk Rekomendasi Program</h4>
            <a href="{{ route('home') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="card-body">
        @if($siswas->isEmpty())
            <div class="alert alert-info">
                Belum ada data siswa. Silakan tambahkan siswa terlebih dahulu.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Siswa</th>
                            <th>Usia</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Kegiatan Saat Ini</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->usia }} tahun</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
                            <td>{{ $siswa->kegiatan }}</td>
                            <td>
                                <a href="{{ route('keputusan.show', $siswa->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-graph-up"></i> Rekomendasi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <div class="alert alert-info">
                    <strong>Informasi:</strong> Pilih siswa untuk melihat rekomendasi program kegiatan yang sesuai.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
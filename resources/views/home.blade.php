@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswaCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                    </div>
                    <a href="{{ route('siswas.index') }}" class="small text-primary stretched-link">Lihat detail</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Program</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $programCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-task fs-1 text-success"></i>
                        </div>
                    </div>
                    <a href="{{ route('programs.index') }}" class="small text-success stretched-link">Lihat detail</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kriteria Penilaian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteriaCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard-data fs-1 text-info"></i>
                        </div>
                    </div>
                    <a href="{{ route('kriterias.index') }}" class="small text-info stretched-link">Lihat detail</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rekomendasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $recentKeputusan->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up fs-1 text-warning"></i>
                        </div>
                    </div>
                    <a href="{{ route('keputusan.index') }}" class="small text-warning stretched-link">Lihat detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Siswa Terbaru</h6>
                    <a href="{{ route('siswas.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    @if($recentSiswas->isEmpty())
                        <div class="alert alert-info">Belum ada data siswa</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSiswas as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->kelas }}</td>
                                        <td>
                                            <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Recommendations -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Terakhir</h6>
                </div>
                <div class="card-body">
                    @if($recentKeputusan->isEmpty())
                        <div class="alert alert-info">Belum ada rekomendasi</div>
                    @else
                        <div class="list-group">
                            @foreach($recentKeputusan as $siswa)
                            <a href="{{ route('keputusan.hasil', $siswa->id) }}" 
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $siswa->nama }}</h6>
                                    <small>{{ $siswa->updated_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Program: {{ $siswa->rekomendasi_program ?? 'Belum ada rekomendasi' }}</p>
                                <small>Kelas: {{ $siswa->kelas }}</small>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Sistem Pendukung Keputusan</h6>
        </div>
        <div class="card-body">
            <p>Sistem ini membantu dalam menentukan program kegiatan yang sesuai untuk siswa TK Bunda Khodijah berdasarkan kriteria tertentu.</p>
            <p class="mb-0">Gunakan menu navigasi di sebelah kiri untuk mengakses seluruh fitur sistem.</p>
        </div>
    </div>
</div>
@endsection
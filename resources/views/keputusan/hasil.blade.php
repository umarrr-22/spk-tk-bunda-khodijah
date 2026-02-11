@extends('layouts.app')

@section('title', 'Hasil Rekomendasi untuk ' . $siswa->nama)

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Hasil Rekomendasi Program untuk {{ $siswa->nama }}</h4>
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
                        <td>{{ $siswa->usia }} tahun ({{ $siswa->getAgeCategory() }})</td>
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
                <h5>Analisis Kesesuaian Umum</h5>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> {{ $siswa->getAgeRecommendation() }}
                </div>
            </div>
        </div>

        <h4 class="mb-3">Hasil Perhitungan Metode SAW</h4>
        
        @if(count($results) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Peringkat</th>
                            <th>Program</th>
                            <th>Total Skor</th>
                            <th>Kesesuaian Usia</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $index => $result)
                        <tr class="{{ $index == 0 ? 'table-success' : '' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $result['program']->nama }}</strong>
                                <div class="small text-muted">{{ $result['program']->deskripsi }}</div>
                            </td>
                            <td>{{ number_format($result['total'], 3) }}</td>
                            <td>
                                @if($result['age_compatibility'] >= 0.8)
                                    <span class="badge bg-success">Sangat Sesuai</span>
                                @elseif($result['age_compatibility'] >= 0.5)
                                    <span class="badge bg-warning text-dark">Cukup Sesuai</span>
                                @else
                                    <span class="badge bg-danger">Kurang Sesuai</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#detail-{{ $index }}">
                                    <i class="bi bi-chevron-down"></i> Detail
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="p-0">
                                <div class="collapse" id="detail-{{ $index }}">
                                    <div class="p-3 bg-light">
                                        <h6>Detail Penilaian:</h6>
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Kriteria</th>
                                                    <th>Nilai</th>
                                                    <th>Bobot</th>
                                                    <th>Nilai Terbobot</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($result['details'] as $detail)
                                                <tr>
                                                    <td>{{ $detail['kriteria'] }}</td>
                                                    <td>{{ $detail['nilai'] }}</td>
                                                    <td>{{ number_format($detail['bobot'], 3) }}</td>
                                                    <td>{{ number_format($detail['weighted'], 3) }}</td>
                                                    <td>
                                                        @if($detail['kriteria'] == 'Kesesuaian Usia')
                                                            @if($detail['nilai'] >= 4)
                                                                <span class="text-success">Sangat sesuai untuk usia {{ $siswa->usia }} tahun</span>
                                                            @elseif($detail['nilai'] >= 2)
                                                                <span class="text-warning">Cukup sesuai dengan pengawasan</span>
                                                            @else
                                                                <span class="text-danger">Kurang sesuai untuk usia ini</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-success mt-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h4 class="alert-heading">Rekomendasi Program Terbaik:</h4>
                        <h3 class="text-primary">{{ $results[0]['program']->nama }}</h3>
                        <hr>
                        <p class="mb-2"><strong>Alasan Rekomendasi:</strong></p>
                        <ul>
                            <li>Total skor tertinggi ({{ number_format($results[0]['total'], 3) }})</li>
                            <li>Kesesuaian usia: {{ $results[0]['age_compatibility'] >= 0.8 ? 'Sangat Baik' : 'Cukup Baik' }}</li>
                            <li>Mempertimbangkan minat dan kebutuhan siswa</li>
                            <li>Tingkat kesulitan sesuai kemampuan motorik</li>
                        </ul>
                        <p class="mb-0"><strong>Deskripsi Program:</strong> {{ $results[0]['program']->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada data penilaian untuk siswa ini. 
                Silakan <a href="{{ route('keputusan.show', $siswa->id) }}">input nilai</a> terlebih dahulu.
            </div>
        @endif
    </div>
    
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <a href="{{ route('keputusan.show', $siswa->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit Nilai
            </a>
            <a href="{{ route('keputusan.index') }}" class="btn btn-primary">
                <i class="bi bi-list-ul"></i> Lihat Semua Siswa
            </a>
        </div>
    </div>
</div>
@endsection
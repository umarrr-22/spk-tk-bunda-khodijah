@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Nilai Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('nilais.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="siswa_id" class="form-label">Siswa</label>
                        <select class="form-select @error('siswa_id') is-invalid @enderror" 
                                id="siswa_id" name="siswa_id" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->kelas }})
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program</label>
                        <select class="form-select @error('program_id') is-invalid @enderror" 
                                id="program_id" name="program_id" required>
                            <option value="">Pilih Program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kriteria_id" class="form-label">Kriteria</label>
                        <select class="form-select @error('kriteria_id') is-invalid @enderror" 
                                id="kriteria_id" name="kriteria_id" required>
                            <option value="">Pilih Kriteria</option>
                            @foreach($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->nama }} (Bobot: {{ $kriteria->bobot }})
                                </option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai (1-5)</label>
                        <select class="form-select @error('nilai') is-invalid @enderror" 
                                id="nilai" name="nilai" required>
                            <option value="">Pilih Nilai</option>
                            <option value="1" {{ old('nilai') == '1' ? 'selected' : '' }}>1 - Sangat Tidak Sesuai</option>
                            <option value="2" {{ old('nilai') == '2' ? 'selected' : '' }}>2 - Tidak Sesuai</option>
                            <option value="3" {{ old('nilai') == '3' ? 'selected' : '' }}>3 - Cukup Sesuai</option>
                            <option value="4" {{ old('nilai') == '4' ? 'selected' : '' }}>4 - Sesuai</option>
                            <option value="5" {{ old('nilai') == '5' ? 'selected' : '' }}>5 - Sangat Sesuai</option>
                        </select>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('nilais.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
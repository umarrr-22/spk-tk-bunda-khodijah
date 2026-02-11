@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Kriteria Penilaian</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kriterias.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kriteria</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="bobot" class="form-label">Bobot (0-1)</label>
                <input type="number" step="0.01" min="0" max="1" 
                       class="form-control @error('bobot') is-invalid @enderror" 
                       id="bobot" name="bobot" value="{{ old('bobot') }}" required>
                @error('bobot')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Contoh: 0.3 untuk bobot 30%</small>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('kriterias.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
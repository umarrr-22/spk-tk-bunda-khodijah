@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Data Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('siswas.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="usia" class="form-label">Usia (3-6 tahun)</label>
                        <input type="number" min="3" max="6" 
                               class="form-control @error('usia') is-invalid @enderror" 
                               id="usia" name="usia" value="{{ old('usia') }}" required>
                        @error('usia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select @error('kelas') is-invalid @enderror" 
                                id="kelas" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            <option value="TK A" {{ old('kelas') == 'TK A' ? 'selected' : '' }}>TK A</option>
                            <option value="TK B" {{ old('kelas') == 'TK B' ? 'selected' : '' }}>TK B</option>
                        </select>
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <select class="form-select @error('kegiatan') is-invalid @enderror" 
                        id="kegiatan" name="kegiatan" required>
                    <option value="">Pilih Kegiatan</option>
                    @foreach($kegiatanOptions as $option)
                        <option value="{{ $option }}" {{ old('kegiatan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @error('kegiatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus</label>
                <input type="text" class="form-control @error('kebutuhan_khusus') is-invalid @enderror" 
                       id="kebutuhan_khusus" name="kebutuhan_khusus" value="{{ old('kebutuhan_khusus') }}">
                @error('kebutuhan_khusus')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Nilai Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('nilais.update', $nilai->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Siswa</label>
                        <input type="text" class="form-control" 
                               value="{{ $nilai->siswa->nama }} ({{ $nilai->siswa->kelas }})" readonly>
                        <input type="hidden" name="siswa_id" value="{{ $nilai->siswa_id }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Program</label>
                        <input type="text" class="form-control" 
                               value="{{ $nilai->program->nama }}" readonly>
                        <input type="hidden" name="program_id" value="{{ $nilai->program_id }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Kriteria</label>
                        <input type="text" class="form-control" 
                               value="{{ $nilai->kriteria->nama }} (Bobot: {{ $nilai->kriteria->bobot }})" readonly>
                        <input type="hidden" name="kriteria_id" value="{{ $nilai->kriteria_id }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai (1-5)</label>
                        <select class="form-select @error('nilai') is-invalid @enderror" 
                                id="nilai" name="nilai" required>
                            <option value="">Pilih Nilai</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('nilai', $nilai->nilai) == $i ? 'selected' : '' }}>
                                    {{ $i }} - {{ $i == 1 ? 'Sangat Tidak Sesuai' : ($i == 5 ? 'Sangat Sesuai' : 'Sesuai') }}
                                </option>
                            @endfor
                        </select>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('nilais.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
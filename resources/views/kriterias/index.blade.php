@extends('layouts.app')

@section('title', 'Kriteria Penilaian')

@section('action-buttons')
    <a href="{{ route('kriterias.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kriteria
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kriterias as $index => $kriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('kriterias.edit', $kriteria->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('kriterias.destroy', $kriteria->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus kriteria ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data kriteria</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3">
            <strong>Total Bobot:</strong> {{ $totalBobot }} 
            @if($totalBobot != 1)
                <span class="text-danger">(Harus tepat 1)</span>
            @endif
        </div>
    </div>
</div>
@endsection
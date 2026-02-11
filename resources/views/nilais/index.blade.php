@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('action-buttons')
    <a href="{{ route('nilais.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Nilai
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
                        <th>Siswa</th>
                        <th>Program</th>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nilais as $index => $nilai)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $nilai->siswa->nama }}</td>
                        <td>{{ $nilai->program->nama }}</td>
                        <td>{{ $nilai->kriteria->nama }}</td>
                        <td>{{ $nilai->nilai }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('nilais.edit', $nilai->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('nilais.destroy', $nilai->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus nilai ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data nilai</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $nilais->links() }}
        </div>
    </div>
</div>
@endsection
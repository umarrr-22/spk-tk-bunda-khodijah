@extends('layouts.app')

@section('title', 'Program Kegiatan')

@section('action-buttons')
    <a href="{{ route('programs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Program
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
                        <th>Nama Program</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programs as $index => $program)
                    <tr>
                        <td>{{ ($programs->currentPage() - 1) * $programs->perPage() + $index + 1 }}</td>
                        <td>{{ $program->nama }}</td>
                        <td>{{ Str::limit($program->deskripsi, 50) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus program ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data program</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $programs->links() }}
        </div>
    </div>
</div>
@endsection
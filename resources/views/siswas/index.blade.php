@extends('layouts.app')

@section('title', 'Data Siswa')

@section('action-buttons')
    <a href="{{ route('siswas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
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
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->usia }} tahun</td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td>{{ Str::limit($siswa->kegiatan, 30) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus data siswa ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $siswas->links() }}
        </div>
    </div>
</div>
@endsection
@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Page</h1>
        <a href="{{ route('page.tambah') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Page
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session()->has('pesan'))
                <div class="alert alert-{{ session('pesan')[0] }}">
                    {{ session('pesan')[1] }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Page</th>
                            <th width="15%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($page as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->judul_page }}</td>
                            <td>
                                <span class="badge badge-{{ $row->status_page == 1 ? 'success' : 'danger' }}">
                                    {{ $row->status_page == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('page.ubah', $row->id_page) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('page.hapus', $row->id_page) }}" onclick="return confirm('Yakin mau hapus?')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
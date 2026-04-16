@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('user.tambah') }}" class="btn btn-primary btn-sm">Tambah User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                                <a href="{{ route('user.ubah', $row->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="{{ route('user.hapus', $row->id) }}" onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger btn-sm">Hapus</a>
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
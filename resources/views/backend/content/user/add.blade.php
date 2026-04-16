@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('user.prosesTambah') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <p class="text-muted">*Password default: 12345678</p>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
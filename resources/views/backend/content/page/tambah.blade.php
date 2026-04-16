@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Page</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('page.prosesTambah') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Page</label>
                    <input type="text" name="judul_page" value="{{ old('judul_page') }}" class="form-control @error('judul_page') is-invalid @enderror">
                    @error('judul_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Page</label>
                    <textarea name="isi_page" id="editor" class="form-control @error('isi_page') is-invalid @enderror">{{ old('isi_page') }}</textarea>
                    @error('isi_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('page.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
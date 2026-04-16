@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Page</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('page.prosesUbah') }}" method="POST">
                @csrf
                <input type="hidden" name="id_page" value="{{ $page->id_page }}">
                
                <div class="mb-3">
                    <label class="form-label">Judul Page</label>
                    <input type="text" name="judul_page" value="{{ $page->judul_page }}" class="form-control @error('judul_page') is-invalid @enderror">
                    @error('judul_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Page</label>
                    <select name="status_page" class="form-control">
                        <option value="1" {{ $page->status_page == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $page->status_page == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Page</label>
                    <textarea name="isi_page" id="editor" class="form-control @error('isi_page') is-invalid @enderror">{{ $page->isi_page }}</textarea>
                    @error('isi_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('page.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
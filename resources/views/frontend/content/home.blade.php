{{-- Anggap saja kamu sudah buat frontend/layout/main.blade.php --}}
@extends('frontend.layout.main')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <h2>Berita Terbaru</h2>
            <hr>
            <div class="row">
                @foreach($berita as $row)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img src="{{ route('storage', $row->gambar_berita) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $row->judul_berita }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($row->isi_berita), 100) }}</p>
                            <a href="{{ route('home.detailBerita', $row->id_berita) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        {{-- Sidebar untuk kategori atau widget lainnya --}}
        <div class="col-lg-4">
            <h4>Kategori</h4>
            <ul class="list-group">
                @foreach($kategori as $k)
                <li class="list-group-item">{{ $k->nama_kategori }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
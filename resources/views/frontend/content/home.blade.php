@extends('frontend.layout.main')
@section('content')
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Portal Berita Terkini</h1>
                    <p class="lead fw-normal text-white-50 mb-4">Dapatkan informasi terupdate seputar teknologi dan informasi setiap hari.</p>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            {{-- Berita Terbaru (Looping) --}}
            <div class="col-lg-8">
                <h2 class="fw-bolder mb-4">Berita Terbaru</h2>
                <div class="row">
                    @foreach($berita as $row)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{ route('storage', $row->gambar_berita) }}" alt="{{ $row->judul_berita }}" />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $row->kategori->nama_kategori }}</div>
                                <a class="text-decoration-none link-dark stretched-link" href="{{ route('home.detailBerita', $row->id_berita) }}">
                                    <h5 class="card-title mb-3">{{ $row->judul_berita }}</h5>
                                </a>
                                <p class="card-text mb-0">{{ Str::limit(strip_tags($row->isi_berita), 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.semuaBerita') }}" class="btn btn-primary">Lihat Semua Berita</a>
            </div>

            {{-- Sidebar Most Views --}}
            <div class="col-lg-4">
                <h2 class="fw-bolder mb-4">Paling Populer</h2>
                @foreach($most_views as $mv)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <small class="text-muted">{{ $mv->total_views }} views</small>
                        <a href="{{ route('home.detailBerita', $mv->id_berita) }}" class="text-decoration-none link-dark">
                            <h6 class="fw-bold">{{ $mv->judul_berita }}</h6>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
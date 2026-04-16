@extends('frontend.layout.main')
@section('content')

<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bolder">Semua Berita</h1>
            <p class="lead fw-normal text-muted mb-0">Kumpulan informasi dan berita terbaru dari kami</p>
        </div>
        
        <div class="row gx-5">
            {{-- Looping Semua Berita --}}
            @foreach($berita as $row)
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="{{ route('storage', $row->gambar_berita) }}" alt="{{ $row->judul_berita }}" />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">
                            {{ $row->kategori->nama_kategori }}
                        </div>
                        <a class="text-decoration-none link-dark stretched-link" href="{{ route('home.detailBerita', $row->id_berita) }}">
                            <h5 class="card-title mb-3">{{ $row->judul_berita }}</h5>
                        </a>
                        <p class="card-text mb-0">
                            {{ Str::limit(strip_tags($row->isi_berita), 120) }} {{-- Potong teks agar rapi --}}
                        </p>
                    </div>
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="small">
                                    <div class="fw-bold">Admin</div>
                                    <div class="text-muted">{{ optional($row->created_at)->format('M d, Y') ?? 'Tanggal tidak tersedia' }} &middot; {{ $row->total_views }} views</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Navigasi Halaman (Pagination) --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $berita->links() }}
        </div>
    </div>
</section>

@endsection
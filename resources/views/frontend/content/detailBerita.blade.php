@extends('frontend.layout.main')
@section('content')
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10">
                <article>
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1">{{ $berita->judul_berita }}</h1>
                        <div class="text-muted fst-italic mb-2">Diposting pada {{ $berita->created_at?->format('d M Y') ?? 'Tanggal tidak tersedia' }} - {{ $berita->total_views }} views</div>
                        <span class="badge bg-secondary text-decoration-none link-light">{{ $berita->kategori->nama_kategori }}</span>
                    </header>
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ route('storage', $berita->gambar_berita) }}" alt="..." /></figure>
                    <section class="mb-5">
                        {!! $berita->isi_berita !!} {{-- Menampilkan HTML dari CKEditor --}}
                    </section>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
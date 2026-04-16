@extends('frontend.layout.main')
@section('content')
    <section class="py-5">
        <div class="container px-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="fw-bolder fs-5 mb-0">Semua Berita</h2>
                <a class="text-decoration-none" href="{{ route('home.index') }}">Kembali</a>
            </div>

            <div class="row gx-5">
                @forelse ($berita as $row)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{ asset('storage/berita/' . $row->gambar_berita) }}"
                                onerror="this.onerror=null;this.src='https://dummyimage.com/600x350/ced4da/6c757d';"
                                alt="{{ $row->judul_berita }}" />

                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">
                                    {{ $row->kategori?->nama_kategori }}
                                </div>
                                <a class="text-decoration-none link-dark stretched-link"
                                    href="{{ route('home.detailBerita', $row->id_berita) }}">
                                    <div class="h5 card-title mb-2">{{ $row->judul_berita }}</div>
                                </a>
                                <p class="card-text mb-0">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($row->isi_berita), 140) }}
                                </p>
                            </div>

                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="small text-muted">{{ $row->created_at?->format('F j, Y') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-muted">Belum ada berita.</div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{ $berita->links() }}
            </div>
        </div>
    </section>
@endsection

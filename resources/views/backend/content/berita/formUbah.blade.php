@extends('backend/layout/main')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Form Ubah Berita</h1>

        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="{{route('berita.prosesUbah')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text"
                               name="judul_berita"
                               value="{{$berita->judul_berita}}"
                               class="form-control @error('judul_berita') is-invalid @enderror">

                        @error('judul_berita')
                        <span style="color:red;font-weight:600;font-size:9pt">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Kategori Berita</label>

                        <select name="id_kategori"
                                class="form-control @error('id_kategori') is-invalid @enderror">

                            @foreach($kategori as $row)
                                <option value="{{$row->id_kategori}}"
                                    {{$row->id_kategori == $berita->id_kategori ? 'selected' : ''}}>
                                    {{$row->nama_kategori}}
                                </option>
                            @endforeach

                        </select>

                        @error('id_kategori')
                        <span style="color:red;font-weight:600;font-size:9pt">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Gambar Berita</label>

                        <input type="file"
                               name="gambar_berita"
                               class="form-control @error('gambar_berita') is-invalid @enderror"
                               accept="image/*"
                               onchange="previewGambar(event)">

                        @error('gambar_berita')
                        <span style="color:red;font-weight:600;font-size:9pt">{{$message}}</span>
                        @enderror

                        <p class="mt-2">Gambar Saat Ini:</p>

                        <img id="preview"
                             src="{{ asset('storage/'.$berita->gambar_berita) }}"
                             width="150">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>

                        <textarea name="isi_berita"
                                  rows="6"
                                  class="form-control @error('isi_berita') is-invalid @enderror">{{$berita->isi_berita}}</textarea>

                        @error('isi_berita')
                        <span style="color:red;font-weight:600;font-size:9pt">{{$message}}</span>
                        @enderror
                    </div>


                    <input type="hidden" name="id_berita" value="{{$berita->id_berita}}">


                    <button type="submit" class="btn btn-primary">Ubah</button>

                    <a href="{{route('berita.index')}}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>
    </div>


    <script>
        function previewGambar(event)
        {
            let reader = new FileReader();

            reader.onload = function(){
                let output = document.getElementById('preview');
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection

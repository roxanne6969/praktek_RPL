@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Menu</h1>
    <div class="card shadow mb-4 col-md-8">
        <div class="card-body">
            <form action="{{ route('menu.prosesUbah') }}" method="POST">
                @csrf
                <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                
                <div class="mb-3">
                    <label>Nama Menu</label>
                    <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Menu</label><br>
                    <input type="radio" name="jenis_menu" value="page" id="radioPage" {{ $menu->jenis_menu == 'page' ? 'checked' : '' }}> Page
                    <input type="radio" name="jenis_menu" value="url" id="radioUrl" class="ml-3" {{ $menu->jenis_menu == 'url' ? 'checked' : '' }}> URL
                </div>

                {{-- Konten Dinamis diatur jQuery di bawah --}}
                <div id="tampilPage" class="mb-3" style="{{ $menu->jenis_menu == 'url' ? 'display:none;' : '' }}">
                    <label>Pilih Page</label>
                    <select name="link_page" class="form-control">
                        @foreach($page as $p)
                            <option value="{{ $p->id_page }}" {{ $menu->url_menu == $p->id_page ? 'selected' : '' }}>{{ $p->judul_page }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="tampilUrl" class="mb-3" style="{{ $menu->jenis_menu == 'page' ? 'display:none;' : '' }}">
                    <label>Link URL</label>
                    <input type="text" name="link_url" value="{{ $menu->url_menu }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status Menu</label>
                    <select name="status_menu" class="form-control">
                        <option value="1" {{ $menu->status_menu == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $menu->status_menu == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#radioPage').click(function(){
            $('#tampilPage').show();
            $('#tampilUrl').hide();
        });
        $('#radioUrl').click(function(){
            $('#tampilUrl').show();
            $('#tampilPage').hide();
        });
    });
</script>
@endsection
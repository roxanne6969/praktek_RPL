@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Menu</h1>
    <div class="card shadow mb-4 col-md-8">
        <div class="card-body">
            <form action="{{ route('menu.prosesTambah') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Menu</label>
                    <input type="text" name="nama_menu" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Menu</label><br>
                    <input type="radio" name="jenis_menu" value="page" id="radioPage" checked> Page
                    <input type="radio" name="jenis_menu" value="url" id="radioUrl" class="ml-3"> URL
                </div>

                <div id="tampilPage" class="mb-3">
                    <label>Pilih Page</label>
                    <select name="link_page" class="form-control">
                        @foreach($page as $p)
                            <option value="{{ $p->id_page }}">{{ $p->judul_page }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="tampilUrl" class="mb-3" style="display:none;">
                    <label>Link URL</label>
                    <input type="text" name="link_url" class="form-control" placeholder="https://example.com">
                </div>

                <div class="mb-3">
                    <label>Target</label>
                    <select name="target_menu" class="form-control">
                        <option value="_self">Tab Saat Ini</option>
                        <option value="_blank">Tab Baru</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Parent Menu (Kosongkan jika menu utama)</label>
                    <select name="parent_menu" class="form-control">
                        <option value="0">-- Pilih Parent --</option>
                        @foreach($parent as $pr)
                            <option value="{{ $pr->id_menu }}">{{ $pr->nama_menu }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

{{-- jQuery untuk ganti input otomatis --}}
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
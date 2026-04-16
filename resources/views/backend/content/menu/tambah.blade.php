@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Menu</h1>

        <div class="card shadow mb-4">
            <form action="{{ route('menu.prosesTambah') }}" method="post">
                @csrf

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama_menu" value="{{ old('nama_menu') }}" class="form-control"
                            @error('nama_menu') is-invalid @enderror>
                        @error('nama_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Menu</label>
                        <div class="radio">
                            <input type="radio" value="page" name="jenis_menu" id="page"
                                {{ old('jenis_menu', 'page') == 'page' ? 'checked' : '' }}>
                            <label for="page">Page</label>
                        </div>
                        <div class="radio">
                            <input type="radio" value="url" name="jenis_menu" id="url"
                                {{ old('jenis_menu') == 'url' ? 'checked' : '' }}>
                            <label for="url">URL</label>
                        </div>
                        @error('jenis_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        {{-- <label class="form-label">Link</label> --}}

                        <div id="url_tampil" class="mb-2">
                            <label class="form-label">URL</label>
                            <input type="url" name="link_url" value="{{ old('link_url') }}" class="form-control"
                                placeholder="https://..." @error('link_url') is-invalid @enderror>
                            @error('link_url')
                                <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="page_tampil">
                            <label class="form-label">Page</label>
                            <select name="link_page" class="form-control" @error('link_page') is-invalid @enderror>
                                <option value="">- Pilih Page -</option>
                                @foreach ($page as $row)
                                    <option value="{{ $row->id_page }}"
                                        {{ old('link_page') == $row->id_page ? 'selected' : '' }}>
                                        {{ $row->judul_page }}
                                    </option>
                                @endforeach
                            </select>
                            @error('link_page')
                                <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Target Menu</label>
                        <div class="radio">
                            <input type="radio" value="_self" name="target_menu" id="self"
                                {{ old('target_menu', '_self') == '_self' ? 'checked' : '' }}>
                            <label for="self">Tab saat ini</label>
                        </div>
                        <div class="radio">
                            <input type="radio" value="_blank" name="target_menu" id="blank"
                                {{ old('target_menu') == '_blank' ? 'checked' : '' }}>
                            <label for="blank">Tab baru</label>
                        </div>
                        @error('target_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select name="parent_menu" class="form-control" @error('parent_menu') is-invalid @enderror>
                            <option value="">- Tidak Ada -</option>
                            @foreach ($parentMenu as $pm)
                                <option value="{{ $pm->id_menu }}"
                                    {{ old('parent_menu') == $pm->id_menu ? 'selected' : '' }}>
                                    {{ $pm->nama_menu }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan_menu" value="{{ old('urutan_menu') }}" class="form-control" @error('urutan_menu') is-invalid @enderror>
                        @error('urutan_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_menu" class="form-control" @error('status_menu') is-invalid @enderror>
                            <option value="1" {{ old('status_menu', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_menu') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_menu')
                            <span style="color: red" font-weight: 600; font-size: 9pt>{{ $message }}</span>
                        @enderror
                    </div> --}}
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            function toggleJenisMenu() {
                const jenis = $('input[name="jenis_menu"]:checked').val();

                if (jenis === 'url') {
                    $('#url_tampil').show();
                    $('#page_tampil').hide();
                } else {
                    $('#page_tampil').show();
                    $('#url_tampil').hide();
                }
            }

            $('input[name="jenis_menu"]').on('change', toggleJenisMenu);
            toggleJenisMenu();
        });
    </script>
@endsection

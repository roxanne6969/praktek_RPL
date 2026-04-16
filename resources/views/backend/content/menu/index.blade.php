@extends('backend.layout.main')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Menu</h1>
        <a href="{{ route('menu.tambah') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Menu
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session()->has('pesan'))
                <div class="alert alert-{{ session('pesan')[0] }}">{{ session('pesan')[1] }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Menu</th>
                            <th width="15%">Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menu as $index => $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $row->nama_menu }}</strong>
                                {{-- Looping Submenu --}}
                                <ul class="mt-2">
                                    @foreach($row->submenu as $sub)
                                        <li>
                                            {{ $sub->nama_menu }} 
                                            <small>({{ $sub->status_menu == 1 ? 'Aktif' : 'Tidak' }})</small>
                                            <a href="{{ route('menu.ubah', $sub->id_menu) }}"><i class="fas fa-edit text-info"></i></a>
                                            <a href="{{ route('menu.hapus', $sub->id_menu) }}" onclick="return confirm('Hapus?')"><i class="fas fa-trash text-danger"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $row->status_menu == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                {{-- Logika Panah Atas/Bawah (Swap Order) --}}
                                @if(!$loop->first)
                                    <a href="{{ route('menu.order', [$row->id_menu, $menu[$index-1]->id_menu]) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-up"></i></a>
                                @endif
                                @if(!$loop->last)
                                    <a href="{{ route('menu.order', [$row->id_menu, $menu[$index+1]->id_menu]) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-down"></i></a>
                                @endif
                                <a href="{{ route('menu.ubah', $row->id_menu) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('menu.hapus', $row->id_menu) }}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
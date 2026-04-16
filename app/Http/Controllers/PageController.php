<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
public function index()
    {
        $page = Page::all(); // Ambil semua data page
        return view('backend.content.page.index', compact('page'));
    }

    public function tambah()
    {
        return view('backend.content.page.tambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'judul_page' => 'required',
            'isi_page' => 'required',
        ]);

        $page = new Page();
        $page->judul_page = $request->judul_page;
        $page->isi_page = $request->isi_page;
        $page->status_page = 1; // Default aktif
        $page->save();

        return redirect()->route('page.index')->with('pesan', ['success', 'Berhasil tambah page']);
    }

    public function ubah($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.content.page.ubah', compact('page'));
    }

    public function prosesUbah(Request $request)
    {
        $page = Page::findOrFail($request->id_page);
        $page->judul_page = $request->judul_page;
        $page->isi_page = $request->isi_page;
        $page->status_page = $request->status_page;
        $page->save();

        return redirect()->route('page.index')->with('pesan', ['success', 'Berhasil ubah page']);
    }

    public function hapus($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('page.index')->with('pesan', ['success', 'Berhasil hapus page']);
    }
}

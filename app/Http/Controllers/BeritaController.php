<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->get();
        return view('backend.content.berita.list', compact('berita'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.berita.formTambah', compact('kategori'));
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'judul_berita'  => 'required|string|max:255',
            'isi_berita'    => 'required',
            'id_kategori'   => 'required',
            'gambar_berita' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            $gambar_berita = $request->file('gambar_berita')
                ->store('berita', 'public');

            Berita::create([
                'judul_berita'  => $request->judul_berita,
                'isi_berita'    => $request->isi_berita,
                'id_kategori'   => $request->id_kategori,
                'gambar_berita' => $gambar_berita
            ]);

            return redirect()->route('berita.index')
                ->with('pesan', ['success', 'Berhasil tambah berita']);

        } catch (\Exception $e) {
            return redirect()->route('berita.index')
                ->with('pesan', ['danger', 'Gagal tambah berita : ' . $e->getMessage()]);
        }
    }

    public function ubah($id){
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('backend.content.berita.formUbah', compact('berita', 'kategori'));
    }

    public function prosesUbah(Request $request)
    {
        $request->validate([
            'judul_berita'  => 'required|string|max:255',
            'isi_berita'    => 'required',
            'id_kategori'   => 'required',
            'gambar_berita' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {

            $berita = Berita::findOrFail($request->id_berita);

            if($request->hasFile('gambar_berita')){
                $gambar_berita = $request->file('gambar_berita')
                    ->store('berita', 'public');
            }else{
                $gambar_berita = $berita->gambar_berita;
            }

            $berita->update([
                'judul_berita'  => $request->judul_berita,
                'isi_berita'    => $request->isi_berita,
                'id_kategori'   => $request->id_kategori,
                'gambar_berita' => $gambar_berita
            ]);

            return redirect()->route('berita.index')
                ->with('pesan', ['success', 'Berhasil ubah berita']);

        } catch (\Exception $e) {

            return redirect()->route('berita.index')
                ->with('pesan', ['danger', 'Gagal ubah berita : '.$e->getMessage()]);
        }
    }

    public function hapus($id)
    {
        $berita = Berita::findOrFail($id);

        try {
            // Hapus file gambar dari storage jika ada (Opsional tapi disarankan)
            // Storage::disk('public')->delete('berita/' . $berita->gambar_berita);

            $berita->delete();

            return redirect()->route('berita.index')
                ->with('pesan', ['success', 'Berhasil hapus berita']);

        } catch (\Exception $e) {
            return redirect()->route('berita.index')
                ->with('pesan', ['danger', 'Gagal hapus berita']);
        }
    }
}

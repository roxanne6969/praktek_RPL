<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    public function export()
    {
    $kategori = Kategori::all();
    $pdf = Pdf::loadView('backend.content.kategori.export', compact('kategori'));
    return $pdf->download('kategori.pdf');
    }

    public function index()
    {
        $kategori = Kategori::all();
        return view('backend.content.kategori.list', compact('kategori'));

    }

    public function tambah()
    {
        return view('backend.content.kategori.formTambah');

    }

    public function prosesTambah(Request $request)
    {

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        try {

            Kategori::create($validated);  // 2. di sini kita Gunakan Mass Assignment (Pastikan 'nama_kategori' ada di $fillable pada Model)

            return redirect()->route('kategori.index')
                ->with('pesan', ['success', 'Berhasil tambah kategori']);

        } catch (\Exception $e) {
            return redirect()->route('kategori.index')->with('pesan', ['danger', 'Gagal tambah kategori: ' . $e->getMessage()]);
        }
    }

    public function ubah($id)
    {
        $kategori = Kategori::findOrfail($id);
        return view('backend.content.kategori.formUbah', compact('kategori'));

    }

    public function prosesUbah(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'   => 'required|exists:kategori,id_kategori',
            'nama_kategori' => 'required|string|max:255',
        ]);

        try {
            // Mencari kategori berdasarkan id_kategori
            $kategori = Kategori::findOrFail($validated['id_kategori']);

            $kategori->update([
                'nama_kategori' => $validated['nama_kategori']
            ]);

            return redirect()->route('kategori.index')
                ->with('pesan', ['success', 'Berhasil ubah kategori']);

        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('pesan', ['danger', 'Gagal ubah kategori']);
        }
    }


    public function hapus($id)
    {
        try {

            $kategori = Kategori::findOrFail($id);  // ini Mencari data berdasarkan primary key id_kategori < -- promary key di model
            $kategori->delete();

            return redirect()->route('kategori.index')
                ->with('pesan', ['success', 'Berhasil hapus kategori']);

        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('pesan', ['danger', 'Gagal hapus kategori']);
        }
    }

}

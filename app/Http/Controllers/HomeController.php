<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;   
use App\Models\Kategori; 
use App\Models\Menu;     

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil berita terbaru (beserta kategorinya) sebanyak 6 buah
        $berita = Berita::with('kategori')->latest()->take(6)->get();

        // Mengambil berita paling populer (Most Views)
        $mostViews = Berita::with('kategori')->orderBy('total_views', 'desc')->take(3)->get();

        // Mengambil semua kategori untuk sidebar
        $kategori = Kategori::all();

        // Kirim semua variabel ke view home
        return view('frontend.content.home', compact('berita', 'mostViews', 'kategori'));
    }

    // Fungsi lainnya biarkan saja dulu atau sesuaikan parameternya
    public function detailBerita($id)
    {
        $berita = Berita::with('kategori')->findOrFail($id);
        
        // Update total views setiap berita dibuka
        $berita->total_views += 1;
        $berita->save();

        return view('frontend.content.detailBerita', compact('berita'));
    }
}
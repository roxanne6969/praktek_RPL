<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Berita;
use App\Models\Page;
use Illuminate\Http\Request;  

class HomeController extends Controller
{
private function getMenu()
    {
        // Fungsi pembantu buat nampilin menu dinamis di navbar
        return Menu::with('submenu')
                    ->whereNull('parent_menu')
                    ->where('status_menu', 1)
                    ->orderBy('urutan_menu', 'asc')
                    ->get();
    }

    public function index()
    {
        $menu = $this->getMenu();
        $berita = Berita::with('kategori')->latest()->take(6)->get(); // 6 berita terbaru
        $most_views = Berita::with('kategori')->orderBy('total_views', 'desc')->take(3)->get(); // Terpopuler

        return view('frontend.content.home', compact('menu', 'berita', 'most_views'));
    }

    public function detailBerita($id)
    {
        $menu = $this->getMenu();
        $berita = Berita::findOrFail($id);
        
        // Update jumlah views tiap kali dibuka
        $berita->increment('total_views'); 

        return view('frontend.content.detailBerita', compact('menu', 'berita'));
    }

    public function detailPage($id)
    {
        $menu = $this->getMenu();
        $page = Page::findOrFail($id);
        return view('frontend.content.detailPage', compact('menu', 'page'));
    }

    public function semuaBerita()
    {
        $menu = $this->getMenu();
        $berita = Berita::with('kategori')->latest()->paginate(9); // Pakai pagination
        return view('frontend.content.semuaBerita', compact('menu', 'berita'));
    }
}
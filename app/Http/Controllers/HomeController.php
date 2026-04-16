<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')
            ->latest()
            ->take(6)
            ->get();

        $mostViews = Berita::with('kategori')
            ->orderByDesc('total_views')
            ->take(5)
            ->get();

        return view('frontend.content.home', compact('berita', 'mostViews'));
    }

    public function detailBerita($id)
    {
        $berita = Berita::with('kategori')->findOrFail($id);
        $berita->increment('total_views');

        return view('frontend.content.detail-berita', compact('berita'));
    }

    public function detailPage($id)
    {
        $page = Page::where('status_page', 1)->findOrFail($id);

        return view('frontend.content.detail-page', compact('page'));
    }

    public function semuaBerita()
    {
        $berita = Berita::with('kategori')
            ->latest()
            ->paginate(9);

        return view('frontend.content.semua-berita', compact('berita'));
    }
}

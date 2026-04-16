<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
public function index()
    {
        // Ambil menu utama (parent null) beserta submenunya, diurutkan
        $menu = Menu::with('submenu')
                    ->whereNull('parent_menu')
                    ->orderBy('urutan_menu', 'asc')
                    ->get();
        return view('backend.content.menu.index', compact('menu'));
    }

    public function order($id, $swapId)
    {
        // Logika tukar urutan menu (Swap)
        $menu = Menu::findOrFail($id);
        $swap = Menu::findOrFail($swapId);

        $tempOrder = $menu->urutan_menu;
        $menu->urutan_menu = $swap->urutan_menu;
        $swap->urutan_menu = $tempOrder;

        $menu->save();
        $swap->save();

        return back()->with('pesan', ['success', 'Urutan menu berhasil diubah']);
    }

    public function tambah()
    {
        $page = Page::where('status_page', 1)->get();
        $parent = Menu::whereNull('parent_menu')->where('status_menu', 1)->get();
        return view('backend.content.menu.tambah', compact('page', 'parent'));
    }

    public function prosesTambah(Request $request)
    {
        $request->validate(['nama_menu' => 'required', 'jenis_menu' => 'required']);

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->jenis_menu = $request->jenis_menu;
        $menu->target_menu = $request->target_menu;
        $menu->parent_menu = $request->parent_menu == 0 ? null : $request->parent_menu;
        
        // Cek apakah tipenya URL atau Page
        $menu->url_menu = ($request->jenis_menu == 'url') ? $request->link_url : $request->link_page;
        
        // Set urutan otomatis (cari urutan terakhir + 1)
        $lastOrder = Menu::where('parent_menu', $menu->parent_menu)->max('urutan_menu');
        $menu->urutan_menu = $lastOrder + 1;
        $menu->status_menu = 1;
        $menu->save();

        return redirect()->route('menu.index')->with('pesan', ['success', 'Berhasil tambah menu']);
    }

    public function hapus($id)
    {
        Menu::findOrFail($id)->delete();
        return back()->with('pesan', ['success', 'Berhasil hapus menu']);
    }
}

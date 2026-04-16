<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::whereNull('parent_menu')
            ->with(['submenu' => fn ($q) => $q->orderBy('urutan_menu', 'asc')])
            ->orderBy('urutan_menu', 'asc')
            ->get();

        return view('backend.content.menu.index', compact('menu'));
    }

    public function tambah()
    {
        $page = Page::where('status_page', 1)->orderBy('judul_page', 'asc')->get();

        // Tampilkan parent menu, status aktif dulu baru non-aktif
        $parentMenu = Menu::whereNull('parent_menu')
            ->orderByDesc('status_menu')
            ->orderBy('urutan_menu', 'asc')
            ->get();

        return view('backend.content.menu.tambah', compact('page', 'parentMenu'));
    }

    public function prosesTambah(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'jenis_menu' => 'required|in:url,page',
            'target_menu' => 'required|in:_self,_blank',

            // link sesuai jenis menu (URL boleh absolute atau relative)
            'link_url' => 'nullable|required_if:jenis_menu,url|string|max:255',
            'link_page' => 'nullable|required_if:jenis_menu,page|integer|exists:page,id_page',

            'parent_menu' => 'nullable|integer|exists:menu,id_menu',
            'urutan_menu' => 'nullable|integer',
            'status_menu' => 'nullable|in:0,1',
        ]);

        $parent_menu = $validated['parent_menu'] ?? null;

        $url_menu = $validated['jenis_menu'] === 'url'
            ? $validated['link_url']
            : (string) $validated['link_page'];

        // kalau user isi urutan_manual pakai itu, kalau tidak auto-generate
        $urut = $validated['urutan_menu'] ?? $this->getUrutanMenu($parent_menu);

        $menu = new Menu;
        $menu->nama_menu = $validated['nama_menu'];
        $menu->jenis_menu = $validated['jenis_menu'];
        $menu->url_menu = $url_menu;
        $menu->target_menu = $validated['target_menu'];
        $menu->urutan_menu = $urut;
        $menu->parent_menu = $parent_menu;
        $menu->status_menu = (int) ($validated['status_menu'] ?? 1);

        try {
            $menu->save();

            return redirect(route('menu.index'))->with('pesan', ['success', 'Berhasil tambah menu']);
        } catch (\Exception $e) {
            return redirect(route('menu.index'))->with('pesan', ['danger', 'Gagal tambah menu']);
        }
    }

    private function getUrutanMenu($parent = null)
    {
        $query = Menu::query()
            ->select('urutan_menu')
            ->orderBy('urutan_menu', 'desc');

        if ($parent === null) {
            $query->whereNull('parent_menu');
        } else {
            $query->where('parent_menu', $parent);
        }

        $last = $query->first();

        return $last ? ($last->urutan_menu + 1) : 1;
    }

    public function ubah($id)
    {
        $menu = Menu::findOrFail($id);

        $page = Page::where('status_page', 1)
            ->orderBy('judul_page', 'asc')
            ->get();

        $parentMenu = Menu::whereNull('parent_menu')
            ->where('id_menu', '!=', $menu->id_menu)
            ->orderBy('urutan_menu', 'asc')
            ->get();

        return view('backend.content.menu.ubah', compact('menu', 'parentMenu', 'page'));
    }

    public function prosesUbah(Request $request)
    {
        $validated = $request->validate([
            'id_menu' => 'required|integer|exists:menu,id_menu',
            'nama_menu' => 'required|string|max:255',
            'jenis_menu' => 'required|in:url,page',
            'target_menu' => 'required|in:_self,_blank',

            // link sesuai jenis menu
            'link_url' => 'nullable|required_if:jenis_menu,url|string|max:255',
            'link_page' => 'nullable|required_if:jenis_menu,page|integer|exists:page,id_page',

            'urutan_menu' => 'required|integer',
            'parent_menu' => 'nullable|integer|exists:menu,id_menu',
            'status_menu' => 'required|in:0,1',
        ]);

        $url_menu = $validated['jenis_menu'] === 'url'
            ? $validated['link_url']
            : (string) $validated['link_page'];

        $menu = Menu::findOrFail($validated['id_menu']);
        $menu->nama_menu = $validated['nama_menu'];
        $menu->jenis_menu = $validated['jenis_menu'];
        $menu->url_menu = $url_menu;
        $menu->target_menu = $validated['target_menu'];
        $menu->urutan_menu = $validated['urutan_menu'];
        $menu->parent_menu = $validated['parent_menu'] ?? null;
        $menu->status_menu = (int) $validated['status_menu'];

        try {
            $menu->save();

            return redirect(route('menu.index'))->with('pesan', ['success', 'Menu berhasil diubah']);
        } catch (\Exception $e) {
            return redirect(route('menu.index'))->with('pesan', ['danger', 'Menu gagal diubah']);
        }
    }

    public function hapus($id)
    {
        $menu = Menu::with('submenu')->findOrFail($id);

        try {
            // Hapus submenu dulu supaya tidak meninggalkan data orphan
            if ($menu->submenu->count()) {
                Menu::where('parent_menu', $menu->id_menu)->delete();
            }

            $menu->delete();

            return redirect(route('menu.index'))->with('pesan', ['success', 'Menu berhasil dihapus']);
        } catch (\Exception $e) {
            return redirect(route('menu.index'))->with('pesan', ['danger', 'Menu gagal dihapus']);
        }
    }

    public function order($idMenu, $idSwap)
    {
        $menu = Menu::findOrFail($idMenu);
        $menuOrder = $menu->urutan_menu;

        $swap = Menu::findOrFail($idSwap);
        $swapOrder = $swap->urutan_menu;

        $menu->urutan_menu = $swapOrder;
        $swap->urutan_menu = $menuOrder;

        try {
            $menu->save();
            $swap->save();

            return redirect(route('menu.index'))->with('pesan', ['success', 'Berhasil ubah urutan menu']);
        } catch (\Exception $e) {
            return redirect(route('menu.index'))->with('pesan', ['danger', 'Gagal ubah urutan menu']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{

    public function dashboard()
    {
        $totalBerita = Berita::count();
        $totalKategori = Kategori::count();
        $totalUser = User::count();

        $latestBerita = Berita::with('kategori')->latest()->take(5)->get();

        return view('backend.content.dashboard', compact(
            'totalBerita', 
            'totalKategori', 
            'totalUser', 
            'latestBerita'
        ));
    }

    public function profile()
    {
        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);
        return view('backend.content.profile',compact('user'));

    }

        public function resetPassword()
    {
        return view('backend.content.resetPassword');
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6',
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);

        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);

            try{    
                $user->save();
                return redirect()->route('dashboard.resetPassword')->with('pesan',['success', 'Password berhasil diubah!']);
            } catch (\Exception $e) {
                return redirect()->route('dashboard.resetPassword')->with('pesan',['danger', 'Terjadi kesalahan saat menyimpan password baru!']);
            }
        } else {
            return redirect()->route('dashboard.resetPassword')->with('pesan',['danger', 'Password lama salah!']);
        }
    }

}

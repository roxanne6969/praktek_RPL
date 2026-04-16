<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('backend.content.user.list', compact('user'));
    }

    public function tambah(){
        return view('backend.content.user.formTambah');
    }

    public function prosesTambah(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        try {
            $user->save();
            return redirect(route('user.index'))->with('pesan',['success', 'User berhasil ditambahkan']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('pesan',['danger', 'User gagal ditambahkan']);
        }
    }

    public function ubah($id){
        $user = User::findOrFail($id);
        return view('backend.content.user.formUbah',compact('user'));
    }

    public function prosesUbah(Request $request){
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        try {
            $user->save();
            return redirect(route('user.index'))->with('pesan',['success', 'User berhasil diubah']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('pesan',['danger', 'User gagal di ubah']);
        }
    }

    public function hapus($id){
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('user.index'))->with('pesan',['success', 'User berhasil di hapus']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('pesan',['danger', 'User gagal dihapus']);
        }
    }
}

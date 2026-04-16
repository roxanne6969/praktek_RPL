<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('backend.content.user.list', compact('user'));

    }

    public function tambah()
    {
        return view('backend.content.user.formTambah');

    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('12345678'); 

        try {
            User::create($validated);  // 2. di sini kita Gunakan Mass Assignment (Pastikan 'nama_user' ada di $fillable pada Model)
            return redirect()->route('user.index')->with('pesan', ['success', 'Berhasil tambah user']);
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('pesan', ['danger', 'Gagal tambah user: ']);
        }
    }

    public function ubah($id)
    {
        $user = User::findOrfail($id);
        return view('backend.content.user.formUbah', compact('user'));

    }

    public function prosesUbah(Request $request)
    {
        $validated = $request->validate([
            'id'   => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::findOrFail($request->$id);
        $user->name = $request->name;
        $user->email = $request->email;

        try {

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email']
            ]);

            return redirect()->route('user.index')
                ->with('pesan', ['success', 'Berhasil ubah user']);

        } catch (\Exception $e) {
            return redirect()->route('user.index')
                ->with('pesan', ['danger', 'Gagal ubah user: ' . $e->getMessage()]);
        }
    }


    public function hapus($id)
    {
        try {
            $user = User::findOrFail($id);  // ini Mencari data berdasarkan primary key id_user < -- promary key di model
            $user->delete();
            return redirect()->route('user.index')
                ->with('pesan', ['success', 'Berhasil hapus user']);
        } catch (\Exception $e) {
            return redirect()->route('user.index')
                ->with('pesan', ['danger', 'Gagal hapus user']);
        }
    }

}

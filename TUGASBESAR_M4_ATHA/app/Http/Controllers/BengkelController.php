<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use Illuminate\Http\Request;

class BengkelController extends Controller
{
    // 1. Menampilkan seluruh data bengkel (Bisa diakses Admin & User)
    public function index()
    {
        $bengkels = Bengkel::all();
        return view('bengkel.index', compact('bengkels'));
    }

    // 2. Menampilkan form untuk menambah bengkel (Khusus Admin - dijaga Middleware & Gate)
    public function create()
    {
        return view('bengkel.create');
    }

    // 3. Menyimpan data bengkel baru ke database (Khusus Admin - dijaga Middleware & Gate)
    public function store(Request $request)
    {
        $request->validate([
            'nama_bengkel'  => 'required',
            'alamat'        => 'required',
            'no_telp'       => 'required',
            'jenis_layanan' => 'required',
        ]);

        Bengkel::create($request->all());

        return redirect()->route('bengkel.index')->with('success', 'Data bengkel berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit data bengkel (Khusus Admin - dijaga Middleware & Policy)
    public function edit(Bengkel $bengkel)
    {
        return view('bengkel.edit', compact('bengkel'));
    }

    // 5. Memperbarui data bengkel di database (Khusus Admin - dijaga Middleware & Policy)
    public function update(Request $request, Bengkel $bengkel)
    {
        $request->validate([
            'nama_bengkel'  => 'required',
            'alamat'        => 'required',
            'no_telp'       => 'required',
            'jenis_layanan' => 'required',
        ]);

        $bengkel->update($request->all());

        return redirect()->route('bengkel.index')->with('success', 'Data bengkel berhasil diperbarui!');
    }

    // 6. Menghapus data bengkel yang ada (Khusus Admin - dijaga Middleware & Policy)
    public function destroy(Bengkel $bengkel)
    {
        $bengkel->delete();

        return redirect()->route('bengkel.index')->with('success', 'Data bengkel berhasil dihapus!');
    }
}
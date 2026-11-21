<?php

namespace App\Http\Controllers;

use App\Models\DaftarPaketRental;
use Illuminate\Http\Request;

class PaketRentalController extends Controller
{
    public function index()
    {
        $paket = DaftarPaketRental::orderByDesc('id')->get();
        return view('paket.index', compact('paket'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_paket' => 'required|in:Lepas Kunci,All-in,Luar Kota',
            'durasi' => 'required|integer|min:1',
            'ketentuan' => 'required|max:255',
        ]);

        DaftarPaketRental::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(DaftarPaketRental $paket)
    {
        return view('paket.edit', compact('paket'));
    }

        public function update(Request $request, DaftarPaketRental $paket)
    {
        if ($request->user()->can('ubahJenis', $paket)) {
            $data = $request->validate([
                'jenis_paket' => 'required|in:Lepas Kunci,All-in,Luar Kota',
                'durasi' => 'required|integer|min:1',
                'ketentuan' => 'required|max:255',
            ]);
        } else {
            $data = $request->validate([
                'durasi' => 'required|integer|min:1',
                'ketentuan' => 'required|max:255',
            ]);
        }

        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(DaftarPaketRental $paket)
    {
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
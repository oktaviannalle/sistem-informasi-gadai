<?php

namespace App\Http\Controllers;

use App\Models\BarangGadai;
use App\Models\Nasabah;
use App\Http\Requests\StoreBarangGadaiRequest;
use App\Http\Requests\UpdateBarangGadaiRequest;

class BarangGadaiController extends Controller
{
    public function index()
    {
        $barangGadais = BarangGadai::with('nasabah')->latest()->paginate(10);

        return view('barang-gadai.index', compact('barangGadais'));
    }

    public function create()
    {
        $nasabahs = Nasabah::orderBy('nama')->get();

        return view('barang-gadai.create', compact('nasabahs'));
    }

    public function store(StoreBarangGadaiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        BarangGadai::create($data);

        return redirect()->route('barang-gadai.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(BarangGadai $barang_gadai)
    {
        $nasabahs = Nasabah::orderBy('nama')->get();

        return view('barang-gadai.edit', compact('barang_gadai', 'nasabahs'));
    }

    public function update(UpdateBarangGadaiRequest $request, BarangGadai $barang_gadai)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang_gadai->update($data);

        return redirect()->route('barang-gadai.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(BarangGadai $barang_gadai)
    {
        $barang_gadai->delete();

        return redirect()->route('barang-gadai.index')->with('success', 'Barang berhasil dihapus.');
    }
}

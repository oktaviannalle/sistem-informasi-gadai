<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Http\Requests\StoreNasabahRequest;
use App\Http\Requests\UpdateNasabahRequest;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabahs = Nasabah::latest()->paginate(10);
        return view('nasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(StoreNasabahRequest $request)
    {
        Nasabah::create($request->validated());

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(UpdateNasabahRequest $request, Nasabah $nasabah)
    {
        $nasabah->update($request->validated());

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diperbarui.');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}

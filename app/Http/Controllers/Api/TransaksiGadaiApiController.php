<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiGadaiResource;
use App\Models\BarangGadai;
use App\Models\TransaksiGadai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiGadaiApiController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiGadai::with('barang.nasabah');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return TransaksiGadaiResource::collection($query->latest()->paginate(10));
    }

    public function show(TransaksiGadai $transaksi)
    {
        return new TransaksiGadaiResource($transaksi->load('barang.nasabah'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_gadai_id' => 'required|exists:barang_gadais,id',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'bunga_persen' => 'nullable|numeric|min:0',
            'tenor_bulan' => 'required|integer|min:1',
        ]);

        $barang = BarangGadai::findOrFail($data['barang_gadai_id']);

        if ($barang->transaksi()->where('status', 'aktif')->exists()) {
            return response()->json(['message' => 'Barang ini masih punya transaksi aktif.'], 422);
        }

        $tanggalGadai = Carbon::now();

        $transaksi = TransaksiGadai::create([
            'barang_gadai_id' => $data['barang_gadai_id'],
            'admin_id' => $request->user()->id,
            'tanggal_gadai' => $tanggalGadai,
            'jumlah_pinjaman' => $data['jumlah_pinjaman'],
            'bunga_persen' => $data['bunga_persen'] ?? 5.00,
            'tanggal_jatuh_tempo' => $tanggalGadai->copy()->addMonths($data['tenor_bulan']),
            'status' => 'aktif',
        ]);

        return new TransaksiGadaiResource($transaksi->load('barang.nasabah'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\BarangGadai;
use App\Models\TransaksiGadai;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNasabah = Nasabah::count();
        $totalBarang  = BarangGadai::count();

        $transaksiAktif = TransaksiGadai::where('status', 'aktif')->count();
        $transaksiLunas = TransaksiGadai::where('status', 'lunas')->count();

        $totalPinjamanAktif = TransaksiGadai::where('status', 'aktif')->sum('jumlah_pinjaman');

        $jatuhTempoMendekat = TransaksiGadai::where('status', 'aktif')
            ->whereBetween('tanggal_jatuh_tempo', [Carbon::now(), Carbon::now()->addDays(7)])
            ->with('barang.nasabah')
            ->orderBy('tanggal_jatuh_tempo')
            ->get();

        $transaksiOverdue = TransaksiGadai::where('status', 'aktif')
            ->where('tanggal_jatuh_tempo', '<', Carbon::now())
            ->count();

        $totalBungaTerkumpul = TransaksiGadai::where('status', 'lunas')
            ->get()
            ->sum('total_bunga');

        $transaksiTerbaru = TransaksiGadai::with('barang.nasabah')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalNasabah',
            'totalBarang',
            'transaksiAktif',
            'transaksiLunas',
            'totalPinjamanAktif',
            'jatuhTempoMendekat',
            'transaksiOverdue',
            'totalBungaTerkumpul',
            'transaksiTerbaru'
        ));
    }
}

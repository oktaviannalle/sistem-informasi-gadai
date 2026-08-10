<?php

namespace App\Http\Controllers;

use App\Models\TransaksiGadai;
use App\Models\BarangGadai;
use App\Http\Requests\StoreTransaksiGadaiRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\WhatsAppNotificationService;

class TransaksiGadaiController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiGadai::with('barang.nasabah')->latest()->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        // Hanya tampilkan barang yang belum punya transaksi aktif
        $barangs = BarangGadai::with('nasabah')
            ->whereDoesntHave('transaksi', function ($query) {
                $query->where('status', 'aktif');
            })
            ->get();

        return view('transaksi.create', compact('barangs'));
    }

    public function store(StoreTransaksiGadaiRequest $request)
    {
        $data = $request->validated();
        $tanggalGadai = Carbon::now();
        $tenor = (int) $data['tenor_bulan'];

        TransaksiGadai::create([
            'barang_gadai_id' => $data['barang_gadai_id'],
            'admin_id' => auth()->id(),
            'tanggal_gadai' => $tanggalGadai,
            'jumlah_pinjaman' => $data['jumlah_pinjaman'],
            'bunga_persen' => $data['bunga_persen'],
            // Jatuh tempo dihitung otomatis: tanggal gadai + tenor (bulan)
            'tanggal_jatuh_tempo' => $tanggalGadai->copy()->addMonths($tenor),
            'status' => 'aktif',
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi gadai berhasil dibuat.');
    }

    public function updateStatus(Request $request, TransaksiGadai $transaksi)
    {
        $request->validate([
            'status' => 'required|in:aktif,lunas,lelang',
        ]);

        $transaksi->update(['status' => $request->status]);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diubah menjadi ' . $request->status . '.');
    }

    public function cetak(TransaksiGadai $transaksi)
    {
        $transaksi->load(['barang.nasabah', 'admin']);

        return view('transaksi.cetak', compact('transaksi'));
    }

    public function kirimPengingat(TransaksiGadai $transaksi, WhatsAppNotificationService $waService)
    {
        $result = $waService->sendReminder($transaksi);

        if ($result['success']) {
            return redirect()->back()->with('success', 'Notifikasi WhatsApp pengingat jatuh tempo berhasil dikirim ke ' . $result['target_phone'] . '.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    public function destroy(TransaksiGadai $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

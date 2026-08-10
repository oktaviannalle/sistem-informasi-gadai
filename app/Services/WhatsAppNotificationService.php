<?php

namespace App\Services;

use App\Models\TransaksiGadai;
use Illuminate\Support\Facades\Log;

class WhatsAppNotificationService
{
    /**
     * Kirim notifikasi pengingat jatuh tempo ke WhatsApp nasabah.
     */
    public function sendReminder(TransaksiGadai $transaksi): array
    {
        $nasabah = $transaksi->barang->nasabah ?? null;

        if (!$nasabah) {
            return [
                'success' => false,
                'message' => 'Data nasabah tidak ditemukan.',
            ];
        }

        $noHp = $nasabah->no_hp;
        $namaNasabah = $nasabah->nama;
        $namaBarang = $transaksi->barang->nama_barang;
        $jatuhTempo = $transaksi->tanggal_jatuh_tempo->format('d-m-Y');
        $totalTebusan = 'Rp ' . number_format($transaksi->total_tebusan, 0, ',', '.');

        $pesan = "Halo Sdr/i *{$namaNasabah}*,\n\n";
        $pesan .= "Kami dari *GADAI STARTECH* menginformasikan mengenai transaksi gadai barang Anda:\n";
        $pesan .= "- *Barang*: {$namaBarang}\n";
        $pesan .= "- *Jatuh Tempo*: {$jatuhTempo}\n";
        $pesan .= "- *Total Pelunasan*: {$totalTebusan}\n";

        if ($transaksi->hari_terlambat > 0) {
            $pesan .= "- *Status*: TERLAMBAT ({$transaksi->hari_terlambat} Hari)\n\n";
            $pesan .= "Mohon segera melakukan pelunasan atau perpanjangan gadai di kantor Gadai Startech untuk menghindari proses lelang. Terima kasih.";
        } else {
            $pesan .= "\nMohon lakukan pelunasan sebelum tanggal jatuh tempo. Terima kasih.";
        }

        // Simulasi pengiriman via WhatsApp API Gateway (e.g., Fonnte / Wablas)
        Log::info("Simulasi WA Sent to {$noHp}: \n{$pesan}");

        return [
            'success' => true,
            'target_phone' => $noHp,
            'message_preview' => $pesan,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}

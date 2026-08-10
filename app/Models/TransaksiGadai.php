<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiGadai extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_gadai_id',
        'admin_id',
        'tanggal_gadai',
        'jumlah_pinjaman',
        'bunga_persen',
        'tanggal_jatuh_tempo',
        'status',
    ];

    protected $casts = [
        'tanggal_gadai' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function barang()
    {
        return $this->belongsTo(BarangGadai::class, 'barang_gadai_id');
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'admin_id');
    }

    // Hitung total bunga dalam rupiah
    public function getTotalBungaAttribute()
    {
        return $this->jumlah_pinjaman * ($this->bunga_persen / 100);
    }

    // Hitung total tagihan standar (pokok + bunga)
    public function getTotalTagihanAttribute()
    {
        return $this->jumlah_pinjaman + $this->total_bunga;
    }

    // Hitung hari keterlambatan jika status aktif & melebihi jatuh tempo
    public function getHariTerlambatAttribute()
    {
        if ($this->status !== 'aktif' || !$this->tanggal_jatuh_tempo) {
            return 0;
        }

        $now = \Carbon\Carbon::now()->startOfDay();
        $jatuhTempo = $this->tanggal_jatuh_tempo->copy()->startOfDay();

        if ($now->greaterThan($jatuhTempo)) {
            return (int) $jatuhTempo->diffInDays($now);
        }

        return 0;
    }

    // Hitung denda keterlambatan (0.5% per hari terlambat)
    public function getDendaAttribute()
    {
        $hari = $this->hari_terlambat;
        if ($hari <= 0) {
            return 0;
        }

        // Denda 0.5% per hari dari nilai pinjaman
        return $this->jumlah_pinjaman * 0.005 * $hari;
    }

    // Hitung total tebusan yang harus dibayar (pokok + bunga + denda)
    public function getTotalTebusanAttribute()
    {
        return $this->total_tagihan + $this->denda;
    }
}

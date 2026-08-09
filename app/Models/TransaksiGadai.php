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

    // Hitung total bunga dalam rupiah (dipakai nanti di controller Hari 2)
    public function getTotalBungaAttribute()
    {
        return $this->jumlah_pinjaman * ($this->bunga_persen / 100);
    }

    // Hitung total yang harus dibayar nasabah (pokok + bunga)
    public function getTotalTagihanAttribute()
    {
        return $this->jumlah_pinjaman + $this->total_bunga;
    }
}

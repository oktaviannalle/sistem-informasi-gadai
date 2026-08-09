<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangGadai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'nama_barang',
        'kategori',
        'taksiran_harga',
        'foto',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiGadai::class);
    }
}

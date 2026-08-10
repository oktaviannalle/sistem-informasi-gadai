<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiGadaiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nasabah' => $this->barang->nasabah->nama,
            'barang' => $this->barang->nama_barang,
            'jumlah_pinjaman' => $this->jumlah_pinjaman,
            'bunga_persen' => $this->bunga_persen,
            'total_bunga' => $this->total_bunga,
            'total_tagihan' => $this->total_tagihan,
            'tanggal_gadai' => $this->tanggal_gadai->format('Y-m-d'),
            'tanggal_jatuh_tempo' => $this->tanggal_jatuh_tempo->format('Y-m-d'),
            'status' => $this->status,
        ];
    }
}

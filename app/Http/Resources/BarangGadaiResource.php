<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangGadaiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_barang' => $this->nama_barang,
            'kategori' => $this->kategori,
            'taksiran_harga' => $this->taksiran_harga,
            'foto' => $this->foto ? asset('storage/' . $this->foto) : null,
            'nasabah' => [
                'id' => $this->nasabah->id,
                'nama' => $this->nasabah->nama,
            ],
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NasabahResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'no_ktp' => $this->no_ktp,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'total_barang' => $this->barangGadai()->count(),
        ];
    }
}

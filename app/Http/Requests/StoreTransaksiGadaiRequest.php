<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiGadaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_gadai_id' => 'required|exists:barang_gadais,id',
            'jumlah_pinjaman' => 'required|numeric|min:1',
            'bunga_persen' => 'required|numeric|min:0|max:100',
            'tenor_bulan' => 'required|integer|min:1|max:12',
        ];
    }

    public function messages(): array
    {
        return [
            'barang_gadai_id.required' => 'Pilih barang yang akan digadaikan.',
        ];
    }
}

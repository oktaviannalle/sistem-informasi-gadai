<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangGadaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nasabah_id' => 'required|exists:nasabahs,id',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'taksiran_harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nasabah_id.required' => 'Pilih nasabah pemilik barang.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}

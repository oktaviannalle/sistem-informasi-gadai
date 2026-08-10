<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNasabahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'no_ktp' => ['required', 'string', 'max:20', Rule::unique('nasabahs', 'no_ktp')->ignore($this->nasabah->id)],
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'no_ktp.unique' => 'No KTP ini sudah terdaftar untuk nasabah lain.',
        ];
    }
}

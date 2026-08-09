<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_ktp',
        'no_hp',
        'alamat',
    ];

    public function barangGadai()
    {
        return $this->hasMany(BarangGadai::class);
    }
}

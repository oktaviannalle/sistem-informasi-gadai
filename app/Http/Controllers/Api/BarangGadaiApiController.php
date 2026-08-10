<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangGadaiResource;
use App\Models\BarangGadai;

class BarangGadaiApiController extends Controller
{
    public function index()
    {
        return BarangGadaiResource::collection(BarangGadai::with('nasabah')->paginate(10));
    }

    public function show(BarangGadai $barangGadai)
    {
        return new BarangGadaiResource($barangGadai->load('nasabah'));
    }
}

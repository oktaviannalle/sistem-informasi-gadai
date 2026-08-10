<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NasabahResource;
use App\Models\Nasabah;

class NasabahApiController extends Controller
{
    public function index()
    {
        return NasabahResource::collection(Nasabah::paginate(10));
    }

    public function show(Nasabah $nasabah)
    {
        return new NasabahResource($nasabah);
    }
}

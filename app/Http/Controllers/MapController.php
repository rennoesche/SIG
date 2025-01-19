<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use App\Model\Kota;

class MapController extends Controller
{
    public function getProvinces() {
        return response()->json(Provinsi::with('cities')->get());
    }

    public function getCities() {
        return response()->json(Kota::with('provinces')->get());
    }
}

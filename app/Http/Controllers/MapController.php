<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use App\Model\Kota;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function getProvinces() {
        return response()->json(Provinsi::with('cities')->get());
    }

    public function getCities() {
        return response()->json(Kota::with('provinces')->get());
    }

    public function index() {
        $provinsi_data = DB::table('provinsis')->select( 'name',DB::raw('ST_AsGeoJSON(boundary) as geometry'), 'latitude', 'longitude','pendidikan_s1', 'gdp', 'luas', 'population', 'penduduk_miskin')->get();
        return view('map', compact('provinsi_data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GsonController extends Controller
{
    public function importGeoJson()
    {
        $path = storage_path('app/public/geojson/provinsi.geojson');

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $geoJsonData = file_get_contents($path);
        $geoJsonArray = json_decode($geoJsonData, true);

        if (!isset($geoJsonArray['features'])) {
            return response()->json(['error' => 'Invalid GeoJSON structure'], 400);
        }

        foreach ($geoJsonArray['features'] as $feature) {
            $provinsi = new Provinsi();
            $provinsi->name = $feature['properties']['name'];
            $provinsi->latitude = $feature['properties']['latitude'];
            $provinsi->longitude = $feature['properties']['longitude'];
            $provinsi->populasi = $feature['properties']['populasi'];
            $provinsi->gdp = $feature['properties']['gdp'];
            $provinsi->penduduk_miskin = $feature['properties']['penduduk miskin'];
            $provinsi->usia_produktif = $feature['properties']['usia produktif'];
            $provinsi->pengangguran = $feature['properties']['pengangguran'];
            $provinsi->buta_aksara = $feature['properties']['buta aksara'];
            $provinsi->pendidikan_s1 = $feature['properties']['pendidikan s1'];
            $provinsi->boundary = $feature['geometry']; 
            $provinsi->save();
        }

        return response()->json(['message' => 'GeoJSON data imported successfully']);
    }
}

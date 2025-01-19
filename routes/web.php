<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GsonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/provinsi', function () {
    return view('provinsi');
});

Route::get('/kabupaten', function () {
    return view('kabupaten');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/provinsi', [MapController::class, 'getProvinces']);
Route::get('/cities', [MapController::class, 'getCities']);

Route::get('/import-geojson', [GsonController::class, 'importGeoJson']);
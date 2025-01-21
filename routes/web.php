<?php

use App\Http\Controllers\KabKotaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KabKotaController::class, 'provinsi']);

Route::get('/populasi', [KabKotaController::class, 'populasi']);
Route::get('/kecamatan', [KabKotaController::class, 'kecamatan']);
Route::get('/desa', [KabKotaController::class, 'desa']);
Route::get('/agama', [KabKotaController::class, 'agama']);
Route::get('/pekerjaan', [KabKotaController::class, 'pekerjaan']);
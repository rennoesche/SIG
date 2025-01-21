<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GsonController;


Route::get('/', [MapController::class, 'index']);

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

//    Route::apiResource('brands', BrandController::class);
//    Route::apiResource('owners', OwnerController::class);
Route::apiResource('cars', CarController::class);

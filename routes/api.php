<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('companies', function () {
        return response()->json(['data' => ['company 1', 'company 2', 'company 3']]);
    })->name('companies.index');
});
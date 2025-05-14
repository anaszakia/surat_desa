<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surat/cetak/{id}/{template}', [SuratController::class, 'cetakSurat'])
    ->name('surat.cetak');('surat.cetak');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BmiController;

Route::get('/', function () {
    return view('index');
});


Route::get('/bmi', [BmiController::class, 'index'])->name('bmi.index');
Route::post('/bmi/calculate', [BmiController::class, 'calculate'])->name('bmi.calculate');



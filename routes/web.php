<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', [UploadController::class, 'index'])->name('upload');
Route::post('/', [UploadController::class, 'store'])->name('upload.store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('appointments', AppointmentController::class);
});
Route::get("/admin", [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::post('/admin/modify/{id}', [AdminController::class, 'modify'])->name('admin.modify');
Route::post('/admin/modifyStatus/{id}', [AdminController::class, 'modifyStatus'])->name('admin.modifyStatus');
Route::get('send-mail', [EmailController::class, 'SendEmail']);

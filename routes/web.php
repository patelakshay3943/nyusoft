<?php

use App\Http\Controllers\AvailableSlotsController;
use App\Http\Controllers\BookedSlotsController;
use App\Http\Controllers\UnavailableDaysController;
use App\Http\Controllers\UnavailableSlotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[AvailableSlotsController::class,'index'])->name('available-slot.index');
Route::post('store',[AvailableSlotsController::class,'store'])->name('available-slot.store');

Route::get('unavailable-slots',[UnavailableSlotController::class,'index'])->name('unavailable-slot.index');
Route::post('unavailable-slots/store',[UnavailableSlotController::class,'store'])->name('unavailable-slot.store');

Route::get('unavailable-days',[UnavailableDaysController::class,'index'])->name('unavailable-days.index');
Route::get('unavailable-days/store',[UnavailableDaysController::class,'store'])->name('unavailable-days.store');

Route::get('booked-slots',[BookedSlotsController::class,'index'])->name('booked-slots.index');
Route::post('booked-slots/get-slots',[BookedSlotsController::class,'getBookedSlot'])->name('booked-slots.get-slots');

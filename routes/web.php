<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function () {
Route::get('/report/mypage', [ReportController::class, 'mydata'])->name('report.mypage');
Route::resource('report', ReportController::class);
Route::get('/specification/mypage', [SpecificationController::class, 'mydata'])->name('specification.mypage');
Route::resource('specification', SpecificationController::class);
Route::get('/task/mypage', [TaskController::class, 'mydata'])->name('task.mypage');
Route::resource('task', TaskController::class);
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

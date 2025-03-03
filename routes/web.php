<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;

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
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employee.search');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    
    Route::post('/holidays/{id}', [HolidayController::class, 'store'])->name('holiday.store');
    Route::post('/holidays/extra/{id}', [HolidayController::class, 'extraHoliday'])->name('holiday.extraHoliday');
    
});


require __DIR__.'/auth.php';

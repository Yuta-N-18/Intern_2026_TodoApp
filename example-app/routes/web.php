<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'move_tasks']);
    
    Route::get('/tasks', [TaskController::class, 'showall'])->name('task.showall');

    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('task.store');

    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('task.update');

    Route::delete('tasks/{task}/delete', [TaskController::class, 'destroy'])->name('task.destroy');
});


// Route::get('/hello', [HelloController::class, 'display_hello'])->name('move_hello_page');
// Route::get('/bye', [HelloController::class, 'display_bye'])->name('move_bye_page');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

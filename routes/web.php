<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');&*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route to view all tasks
Route::get('tasks', [TaskController::class, 'showTasks'])->name('tasks.all');
// Route to create
Route::match(['get', 'post'], 'create_tasks', [TaskController::class, 'createTask'])->name('tasks.create');
// Edit Task (GET Request to show the edit form)
Route::get('edit_task/{task_id}', [TaskController::class, 'editTask'])->name('edit.task');

// Update Task (POST Request to handle the form submission)
Route::post('edit_task/{task_id}', [TaskController::class, 'editTask']);

// Route for deleting a task
Route::delete('delete_task/{id}', [TaskController::class, 'deleteTask'])->name('delete.task');

require __DIR__.'/auth.php';

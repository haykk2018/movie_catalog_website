<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'showAllMovies']);
Route::get('/movie/{id}', [MainController::class, 'showMovie']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/admin', [ADminController::class, 'index']);
Route::resources([
    'admin/movie' => AdminController::class,
]);

//php artisan route:list
require __DIR__ . '/auth.php';

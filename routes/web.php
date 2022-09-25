<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
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

//movie controller routes
Route::get('/admin', [MovieController::class, 'index'])->middleware(['auth'])->name('index');;
Route::group(['middleware' => 'auth'], function () {
    Route::resources(['admin/movie' => MovieController::class,]);
});
//category controller routes
Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware(['auth'])->name('index');;
Route::group(['middleware' => 'auth'], function () {
    Route::resources(['admin/category' => CategoryController::class,]);
});

Route::get('uploads/{filename}', function ($filename)
{
    $path = storage_path('app/public/uploads/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

//php artisan route:list
require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

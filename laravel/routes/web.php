<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    if(Auth::check())
    {
        return view('home');
    }
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::post('/posts/{post}/edit', [PostController::class, 'update']);
    Route::post('/posts/{post}/delete', [PostController::class, 'destroy']);
});

Route::fallback(function($route) {
    if(Str::startsWith($route, 'posts')) {
        return redirect()->route('posts');
    }
});


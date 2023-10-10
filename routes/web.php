<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;

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


Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::put('/posts', [PostController::class, 'create'])->name('posts.create');
    Route::patch('/posts', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts', [PostController::class, 'destroy'])->name('posts.delete');
});
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index')->middleware('auth');
Route::put('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

require __DIR__.'/auth.php';

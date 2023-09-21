<?php

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

Route::get('/', function () {
    return redirect(route("home"));
});

Route::get('testing', function () {
    return view('testing');
})->name('testing');

Auth::routes();

Route::get('/home', [App\Http\Controllers\PostController::class, 'home'])->name('home');

Route::middleware(['role:user'])->group(function () {
    Route::get('/posts/my-posts', [App\Http\Controllers\PostController::class, 'myPosts'])->name('posts.my-posts');
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::put('/posts/{post}/publish', [App\Http\Controllers\PostController::class, 'publish'])->name('posts.publish');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');  
    Route::delete('/admin/{user}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/{user}/reset-password', [App\Http\Controllers\AdminController::class, 'resetPassword'])->name('admin.reset-password');
});

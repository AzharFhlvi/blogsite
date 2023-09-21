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

Auth::routes();

Route::get('/home', [App\Http\Controllers\PostController::class, 'home'])->name('home');
Route::get('/posts/my-posts', [App\Http\Controllers\PostController::class, 'myPosts'])->name('posts.my-posts');
Route::resource('posts', App\Http\Controllers\PostController::class);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');  
Route::delete('/admin/{user}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
Route::post('/admin/{user}/reset-password', [App\Http\Controllers\AdminController::class, 'resetPassword'])->name('admin.reset-password');

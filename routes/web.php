<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use Laravel\Socialite\Facades\Socialite;
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
    return view('welcome');
});

Route::get('posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create')->middleware('auth');
Route::post('posts',[PostController::class,'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post}',[PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('posts/{post}',[PostController::class,'update'])->name('posts.update')->middleware('auth');
//Route::resource('/users', 'PostController');
Route::delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();

    // $user->token
});
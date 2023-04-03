<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', HomeController::class)->name('home');

// Route::get('/prueba', function () {
//     return view('prueba');
// });

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Route Perfil

Route::get('perfil-update', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('perfil-update', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comment.store');

Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');



Route::post('/imagens', [ImageController::class, 'store'])->name('image.store');

// Like a la foto

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');

// Delete Like
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.like.destroy');


Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');


//Follower

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');


// Home

Route::get('/{user:username}/wall', [HomeController::class, 'index'])->name('user.home');
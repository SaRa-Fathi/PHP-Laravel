<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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
// Route::get('/', [App\Http\Controllers\HomeController::class, 'login']);//->name('logout');

Auth::routes();

Route::group(['middleware'=>['auth']] , function (){

Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); //->middleware(middleware:'auth');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store']);


Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::get('/posts/{post}/reback', [PostController::class, 'reback'])->name('posts.reback');

Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});




// Route::get('/comments', [CommentController::class, 'show'])->name('posts.show');

// // Route::get('/posts/{post}', [CommentController::class, 'index'])->name('comments.index');
// Route::post('/posts/{post}/comments', [CommentController::class, 'store']); //->name('comments.store');

// // get specific comment for specific post
// Route::get('/comments/{comment}', [CommentController::class, 'show']); //->name('comments.show');

// Route::get('/comments/create', [CommentController::class, 'create'])->name('posts.show');

// Route::post('/comments', [CommentController::class, 'store']);

// Route::get('/comments/{comment}/edit', [CommentController::class, 'edit']); //->name('comments.edit');
// Route::put('/comments/{comment}', [CommentController::class, 'update']); //->name('comments.update');

// // delete specific comment
// Route::delete('/comments/{comment}', [CommentController::class, 'destroy']); //->name('comments.destroy');


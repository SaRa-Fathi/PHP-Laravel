<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/home', [PostController::class, 'index'])->name('posts.index');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'login']);//->name('logout');

Route::get('/auth/redirect/{provider}',[SocialiteController::class , 'redirect'])->name('auth.redirect');

Route::get('/auth/callback/{provider}',[SocialiteController::class , 'callback'])->name('auth.callback');

// Route::get('/auth/github/redirect',[SocialiteController::class , 'redirect']);

// Route::get('/auth/github/callback',[SocialiteController::class , 'callback']);

// Route::get('/auth/redirect/github',[SocialiteController::class , 'redirect'])->name('auth.github.redirect');

// Route::get('/auth/callback/github',[SocialiteController::class , 'callback'])->name('auth.github.callback');

// Route::get('/auth/redirect/google',[SocialiteController::class , 'redirect'])->name('auth.google.redirect');

// Route::get('/auth/callback/google',[SocialiteController::class , 'callback'])->name('auth.google.callback');


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





// Route::get('/auth/redirect/{provider}',[SocialiteController::class , 'redirect']);

// Route::get('/auth/callback/{provider}',[SocialiteController::class , 'callback']);

// function () {
//     $user = Socialite::driver('github')->user();
//     // dd($user);
//     $user = User::updateOrCreate([
//         'github_id' => $githubUser->id,
//     ], [
//         'name' => $githubUser->name,
//         'email' => $githubUser->email,
//         'github_token' => $githubUser->token,
//         'github_refresh_token' => $githubUser->refreshToken,
//     ]);

//     // $user->token
// };






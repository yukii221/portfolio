<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\UserController;

//Route::resource('users', 'UserController',['only'=>['index','show','create','store','destroy']]);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'add'])->name('posts.add');
Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/posts/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
Route::delete('/posts/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/edit',  [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update',  [PostController::class, 'update'])->name('posts.update');


// commentsに関するルーティング
use App\Http\Controllers\CommentController;

Route::prefix('comments')->name('comments.')->middleware('auth')->group(function () {

    // コメント投稿画面表示
    Route::get('/create', [CommentController::class, 'create'])->name('create');
    Route::post('/', [CommentController::class, 'store'])->name('store');

    // コメント編集画面表示
    Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [CommentController::class, 'update'])->name('update');

    // コメント削除処理
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
});


use App\Http\Controllers\AdminController;

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


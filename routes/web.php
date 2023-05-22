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

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('posts.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\UserController;

Route::prefix('users')->name('users.')->middleware('auth')->group(function () {

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/create', [UserController::class, 'create'])->name('create');
Route::post('/', [UserController::class, 'store'])->name('store');
Route::get('/{user}', [UserController::class, 'show'])->name('show');
Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
Route::post('/{user}', [UserController::class, 'update'])->name('update');
Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

});

use App\Http\Controllers\PostController;

Route::prefix('posts')->name('posts.')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'add'])->middleware('auth')->name('add');
    Route::post('/create', [PostController::class, 'create'])->middleware('auth')->name('create');
    Route::get('/edit', [PostController::class, 'edit'])->middleware('auth')->name('edit');
    Route::get('/destroy', [PostController::class, 'destroy'])->middleware('auth')->name('destroy');
    Route::delete('/destroy', [PostController::class, 'destroy'])->middleware('auth')->name('destroy');
    Route::get('/edit',  [PostController::class, 'edit'])->middleware('auth')->name('edit');
    Route::post('/update',  [PostController::class, 'update'])->middleware('auth')->name('update');
    Route::get('comment/{post}', [PostController::class, 'commentCreate'])->name('commentCreate');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('show');

});

use App\Http\Controllers\CommentController;

Route::prefix('comments')->name('comments.')->group(function () {

    Route::post('/create', [CommentController::class, 'create'])->name('create');
    Route::get('/{id}', [CommentController::class, 'index'])->name('index');

});

use App\Http\Controllers\AdminController;

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

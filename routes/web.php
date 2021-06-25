<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageUploadController;

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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::post('/signup', [UserController::class, 'postSignUp'])->name('signup');
    Route::post('/signin', [UserController::class, 'postSignIn'])->name('signin');



    Route::get('/image-upload-preview', [ImageUploadController::class, 'index'])->name('index');
    Route::post('/image-upload', [ImageUploadController::class, 'store']);

    Route::get('/logout', [UserController::class, 'getLogout'])->name('logout');

    Route::group(['middleware'  => ['auth']], function() {
        Route::post('/create-post',[PostController::class, 'postCreatePost'])->name('post.create');

        Route::get('/edit-post/{post_id}', [PostController::class, 'getEditPost'])->name('post.edit');
        Route::post('/post-update/{post_id}', [PostController::class, 'update'])->name('post.update');

        Route::get('/delete-post/{post_id}', [PostController::class, 'getDeletePost'])->name('post.delete');
        Route::get('/dashboard', [PostController::class, 'getDashboard'])->name('dashboard');
    });
});

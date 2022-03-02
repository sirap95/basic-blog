<?php

use App\Http\Controllers\PostController;
use Illuminate\Validation\Factory;
use Illuminate\Http\Request;
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

Route::get('/', [PostController::class, 'getIndex'])->name('guest.index');

Route::get('/post/{id}', [PostController::class, 'getPost'])->name('guest.post');

Route::get('/about', function () {
    return view('other.about');
})->name('other.about');

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('', [PostController::class, 'getAdminIndex'])->name('admin.index');

        Route::get('create', function () {
            return view('admin.create');
        })->name('admin.create');

        Route::get('edit/{id}', [PostController::class, 'getAdminEdit'])->name('admin.edit');

        //POST REQUEST
        Route::post('upload', [\App\Http\Controllers\ImageController::class, 'upload'])->name('admin.upload');
        Route::post('images', [\App\Http\Controllers\ImageController::class, 'index'])->name('admin.images');
        Route::post('create', [PostController::class, 'postAdminCreate'])->name('admin.create');
        Route::post('editPost/{id}', [PostController::class, 'postAdminEdit'])->name('admin.update');

        Route::get('delete/{id}', [PostController::class, 'deleteAdminPost'])->name('admin.delete');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


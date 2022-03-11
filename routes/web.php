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
Route::get('/search', [PostController::class, 'search'])->name('guest.search');

Route::get('/post/{id}', [PostController::class, 'getPost'])->name('guest.post');

Route::get('/about', function () {
    return view('other.about');
})->name('other.about');

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {

    Route::group(['prefix' => 'admin'], function () {
        //GET ROUTES
        Route::get('', [PostController::class, 'getAdminIndex'])->name('admin.index');
        Route::get('create', function () {return view('admin.create');})->name('admin.create');
        Route::get('edit/{id}', [PostController::class, 'getAdminEdit'])->name('admin.edit');
        Route::post('delete/{id}', [PostController::class, 'deleteAdminPost'])->name('admin.delete');

        //POST ROUTES
        Route::post('upload', [PostController::class, 'upload'])->name('admin.upload');
        Route::post('create', [PostController::class, 'postAdminCreate'])->name('admin.create');
        Route::put('editPost/{id}', [PostController::class, 'postAdminEdit'])->name('admin.update');
        });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


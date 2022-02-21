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

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {

        //GET REQUEST

        Route::get('', [PostController::class, 'getAdminIndex'])->name('admin.index');

        Route::get('create', function () {
            return view('admin.create');
        })->name('admin.create');

        Route::get('edit/{id}', [PostController::class, 'getAdminEdit'])->name('admin.edit');

        //POST REQUEST

        Route::post('create', [PostController::class, 'postAdminCreate'])->name('admin.create');

        Route::post('edit', function (Request $request, Factory $validator) {
            $validation = $validator->make($request->all(), [
                'title' => 'required|min:5',
                'content' => 'required|min:10'
            ]);
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation);
            }
            return redirect()->route('admin.index')
                ->with('info', 'Post edited, new title: ' . $request->input('title'));
        })->name('admin.update');

        Route::get('delete/{id}', [PostController::class, 'deleteAdminPost'])->name('admin.delete');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


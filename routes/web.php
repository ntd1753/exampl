<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('login');
});
Route::group(['prefix' => 'post'], function (){
    Route::get('/',[PostController::class,'index'])->name("post.index"); // danh sách
    Route::get('/add', [PostController::class,'add'])->name('post.add'); // Trả về form thêm mới
    Route::post('/add', [PostController::class,'store'])->name('post.store'); // tạo mới
    Route::get('/edit/{id}', [PostController::class,'edit'])->name('post.edit'); // Trả về form edit
    Route::post('/edit/{id}', [PostController::class,'update'])->name('post.update'); // Update
    Route::get('/delete/{id}', [PostController::class,'destroy'])->name('post.destroy'); // delete
});
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name("auth.login.provider");
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('auth.login.provider.callback');

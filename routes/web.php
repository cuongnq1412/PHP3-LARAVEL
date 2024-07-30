<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\CheckRouter;

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






Route::get('/',[HomeController::class, 'index'])->name('home')->middleware('checkuser');
Route::get('/Categories',[CategoryController::class,'index']);
Route::get('/Categories/{id}',[CategoryController::class,'index']);
Route::get('/Article_detail/{id}',[PostController::class,'show']);
Route::get('/About_us',function(){
    return view('aboutUs');
});
Route::get('/Contact',function(){
    return view('contact');
});


Route::middleware(['checkrouter'])->group(function () {
Route::post('/Comment',[CommentController::class,'addcomment'])->name('cmt');
Route::get('/Comment/list',[CommentController::class,'listcomments'])->name('list');
Route::get('/User/list',[AdminUserController::class,'listusers'])->name('listusers');
Route::post('/Upstatuscmt/{id}',[CommentController::class,'upstatuscmt'])->name('Upstatuscmt');
Route::post('/Upstatususer/{id}',[AdminUserController::class,'Upstatususer'])->name('Upstatususer');
Route::resource('/Article',PostController::class);
Route::resource('/Category',CategoryController::class);
});


Auth::routes();




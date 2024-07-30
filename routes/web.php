<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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






Route::get('/',[HomeController::class, 'index']);
Route::get('/Categories',[CategoryController::class,'index']);
Route::get('/Categories/{id}',[CategoryController::class,'index']);
Route::get('/Article_detail/{id}',[PostController::class,'show']);
Route::get('/About_us',function(){
    return view('aboutUs');
});
Route::get('/Contact',function(){
    return view('contact');
});







// admin




Route::middleware(['auth'])->group(function () {

Route::resource('/Article',PostController::class);
Route::resource('/Category',CategoryController::class);
});

//test



// Route::get('/checknav',function(){
//     return view('dangnhap-r');
// });
Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/checknav',function(){
//     // return view('dangnhap-r');
//     return '123';
// });



Route::middleware(['checkrouter'])->group(function () {
    Route::get('/checknav', function () {
        return view('dangnhap-r');
    });
});

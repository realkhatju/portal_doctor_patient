<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PermController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/',[ProfileController::class,'index']);
    //Dashboard
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'adminAccountUpdate'])->name('admin#update');

    //Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('admin#profile');

    //noPerm
    Route::get('permission',[PermController::class,'index']);
    //Change Direct Password
    Route::get('admin/changePassword', [ProfileController::class, 'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

    Route::group(['prefix' => 'admin' , 'middleware' => 'rolePerm_middleware' ],function(){
        //list
        Route::get('list', [ListController::class, 'index'])->name('admin#list');
        Route::post('list',[ListController::class,'adminSearchList'])->name('admin#searchList');
    });

    Route::group(['prefix' => 'diseaseList' , 'middleware' => 'rolePerm_middleware' ],function(){
        //Trend
        Route::get('', [TrendPostController::class, 'index'])->name('admin#trend');
        Route::get('details/{id}',[TrendPostController::class,'details'])->name('admin#trendPostDetails');
    });
    Route::get('details/{id}',[TrendPostController::class,'accept_post']);


    //category
    Route::get('category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::post('category',[CategoryController::class,'categorySearchList'])->name('admin#categorySearchList');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //Post
    Route::get('post', [PostController::class, 'index'])->name('admin#post');
    Route::post('post/create',[PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('post/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost')->middleware('rolePerm_middleware');
    Route::get('post/updatePostPage/{id}',[PostController::class,'updatePostPage'])->name('admin#updatePostPage');
    Route::post('post/update/{id}',[PostController::class,'postUpdate'])->name('admin#postUpdate');


    // Route::post('trendPost',[TrendPostController::class,'trendPostSearchList'])->name('admin#trendPostSearchList');

    // action log create
    Route::post('post/actionLog',[ActionLogController::class,'actionLogCreate']);

    //Direct Delete Account
    Route::get('admin/deleteAccount/{id}',[ListController::class,'deleteAccount'])->name('admin#deleteAccount');

    //Category Delete Account
    Route::get('admin/category/{id}',[CategoryController::class,'deleteCategory'])->name('category#deleteAccount')->middleware('rolePerm_middleware');
});

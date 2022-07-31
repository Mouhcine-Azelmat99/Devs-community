<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\RessourceController;

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

Route::get('/',[HomeController::class,'index'])->name('home');


require __DIR__.'/auth.php';

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


// Google URL
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

// Admin routing
Route::prefix('admin')->name('admin.')->group( function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('users', [AdminController::class, 'getUsers'])->name('users');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::resource('posts',PostController::class);
    Route::put('user/{id}', [AdminController::class, 'setAdmin'])->name('setAdmin');

});

Route::post('/post', [PostController::class, 'addPost'])->name('post.addPost');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/saved', [SaveController::class, 'index'])->name('posts.saved');
Route::get('/category/posts/{category}', [PostController::class, 'postsByCat']);

Route::put('/theme', [HomeController::class, 'changeMode'])->name('theme');

// Ressources
Route::get('/ressources', [RessourceController::class, 'index'])->name('ressources.index');

// profile
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

// Questionnes
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/questions/{slug}', [QuestionController::class, 'showQuestion'])->name('questions.show');

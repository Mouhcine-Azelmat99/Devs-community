<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [PostController::class, 'getPosts']);

Route::get('/posts/{id}', [PostController::class, 'getPosts']);
Route::get('/related', [PostController::class, 'relatedPosts']);
Route::get('/posts/{slug}/{id}', [PostController::class, 'showPost']);
Route::delete('/posts/{id}', [PostController::class, 'deletePost']);
Route::get('/profil/posts/{id}', [PostController::class, 'PubliedPost']);
Route::post('/post', [PostController::class, 'addPost']);
Route::get('/category/posts/{category_id}/{user_id}', [PostController::class, 'getPostsByCategory']);

Route::post('/comment', [CommentController::class, 'store']);
Route::get('/comments/{id}', [CommentController::class, 'getCommentByPost']);
Route::get('/categories', [CategoryController::class, 'getCategories']);


Route::post('/like', [LikeController::class, 'store']);
Route::post('/save', [SaveController::class, 'store']);
Route::get('/saved/{id}', [SaveController::class, 'getSavedPosts']);
Route::delete('/saved/{id}', [SaveController::class, 'delete']);
Route::get('/saved/profil/{id}', [SaveController::class, 'getSavedByUser']);

Route::get('/theme/{mode}', [HomeController::class, 'switchModes']);

Route::get('/search', [PostController::class, 'search']);

// Ressources
Route::post('/source', [SourceController::class, 'store']);
Route::get('/sources', [SourceController::class, 'getSources']);
Route::get('/ressources', [RessourceController::class, 'getRessources']);

// profile
Route::get('/profile/{id}', [HomeController::class, 'profilInfo']);

// questions
Route::get('/questions', [QuestionController::class, 'getQuestions']);
Route::get('/question/{slug}', [QuestionController::class, 'show']);
Route::post('/repond', [QuestionController::class, 'storeSolution']);
Route::post('/question', [QuestionController::class, 'storeQuestion']);
Route::delete('/repond/{id}', [QuestionController::class, 'deleteSolution']);
Route::delete('/questions/{id}', [QuestionController::class, 'deleteQuestion']);


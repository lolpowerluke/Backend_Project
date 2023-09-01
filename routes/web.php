<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [NewsController::class, 'index'])->name('news.index');

Route::resource('news', NewsController::class);

Route::get('/like/{postid}', [LikeController::class, 'like'])->name('like');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/faq', [QuestionsController::class, 'faq'])->name('faq');

Route::get('/question/index', [QuestionsController::class, 'index'])->name('question.index');

Route::resource('question', QuestionsController::class);

Route::resource('comment', CommentController::class);

Route::resource('categorie', CategorieController::class);

Route::resource('user', UserController::class);

Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/users', [AdminController::class, 'adminUsers'])->name('admin.users');

Route::get('/admin/news', [AdminController::class, 'adminNews'])->name('admin.news');

Route::get('/admin/questions', [AdminController::class, 'adminQuestions'])->name('admin.questions');

Route::get('/admin/comments', [AdminController::class, 'adminComments'])->name('admin.comments');

Route::get('/admin/categories', [AdminController::class, 'adminCategories'])->name('admin.categories');

Route::get('/admin/userSearch', [AdminController::class, 'searchUserByName'])->name('admin.userSearch');

Route::get('/admin/makeUserAdmin/{id}', [AdminController::class, 'makeUserAdmin'])->name('admin.makeUserAdmin');

Route::get('/admin/searchUserToDelete', [AdminController::class, 'searchUserToDelete'])->name('admin.searchUserToDelete');

Route::get('/admin/searchNews', [AdminController::class, 'searchNewsByTitle'])->name('admin.searchNews');

Route::get('/admin/searchToAddToFAQ/', [AdminController::class, 'searchToAddToFAQ'])->name('admin.searchToAddToFAQ');

Route::delete('/admin/addToFAQ/{id}', [AdminController::class, 'addToFAQ'])->name('admin.addToFAQ');

Route::get('/admin/addQuestionToCategory/{id}', [AdminController::class, 'addQuestionToCategory'])->name('admin.addQuestionToCategory');

Route::get('/admin/createCategory', [AdminController::class, 'createCategory'])->name('admin.createCategory');

Route::post('/admin/storeCategory', [AdminController::class, 'storeCategory'])->name('admin.storeCategory');

Route::delete('/admin/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

Route::get('/admin/searchCategoriesToRemove', [AdminController::class, 'searchCategoriesToRemove'])->name('admin.searchCategoriesToRemove');

Route::get('/admin/searchToAddToCategory', [AdminController::class, 'searchToAddToCategory'])->name('admin.searchToAddToCategory');

Route::get('/admin/searchQuestionsToRemove', [AdminController::class, 'searchQuestionsToRemove'])->name('admin.searchQuestionsToRemove');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

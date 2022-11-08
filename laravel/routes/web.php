<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\PostModel;
use GuzzleHttp\Psr7\Request;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/post/{id}', [PostController::class, 'display'])->name('post.display');

/**
 * Routes that control post creation
 */

Route::get('/create-post', [PostController::class, 'create'])
->middleware(['auth', 'verified'])->name('post.create');

Route::post('/create-post', [PostController::class, 'store'])
->middleware(['auth', 'verified'])->name('post.store');



/**
 * Routes that control post editing
 */

Route::get('/edit-post/{post_id}', [PostController::class, 'edit'])
->middleware(['auth', 'verified', 'user_owns_post'])->name('post.edit');

Route::post('/edit-post', [PostController::class, 'updatePost'])
->middleware(['auth', 'verified', 'user_owns_post'])->name('post.update');

Route::post('/delete-post/{post_id}', [PostController::class, 'delete'])
->middleware(['auth', 'verified', 'user_owns_post'])->name('post.delete');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/post/{post_id}/images', function ($post_id) {
    return PostModel::firstWhere("post_id", $post_id)->images()->get();
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';

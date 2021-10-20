<?php

use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('postList');

Route::get('/posts/ajouter', [PostController::class, 'add'])->name('postAdd');

Route::post('/posts/ajouter', [PostController::class, 'store'])->name('postStore');

Route::get('/posts/{id}', [PostController::class, 'detail'])->name('postDetail');

Route::post('/posts/{id}/modifier', [PostController::class, 'update'])->name('postUpdate');

Route::delete('/posts/{id}/supprimer', [PostController::class, 'delete'])->name('postDelete');

// http://127.0.0.1:8000/posts/15
// Liste de posts

// Route::get('/posts/{id}/{opt?}', function ($id, $opt = null){
//     dd($id, $opt);
// });

// Route::get('/posts/{id}/{opt?}', function (\Illuminate\Http\Request $request, $id, $opt){
//     dd($request, $id, $opt);
// });

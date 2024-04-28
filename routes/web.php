<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LayoutController;

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

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/category/add', [CategoryController::class, 'add']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);

Route::post('/admin/category/process', [CategoryController::class, 'process']);
Route::post('/admin/category/delete', [CategoryController::class, 'delete']);


Route::get('/admin/post', [PostController::class, 'index']);
Route::get('/admin/post/add', [PostController::class, 'add']);
Route::get('/admin/post/edit/{id}', [PostController::class, 'edit']);

Route::post('/admin/post/process', [PostController::class, 'process']);
Route::post('/admin/post/delete', [PostController::class, 'delete']);

Route::get('/admin/user', [UserController::class, 'index']);
Route::get('/admin/user/add', [UserController::class, 'add']);
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);

Route::post('/admin/user/process', [UserController::class, 'process']);
Route::post('/admin/user/delete', [UserController::class, 'delete']);

Route::get('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::post('/processLogin', [UserController::class, 'processLogin']);

// session
Route::get('/createSession', [UserController::class, 'createSession']);
Route::get('/getSession', [UserController::class, 'getSession']);
Route::get('/deleteSession', [UserController::class, 'deleteSession']);

// layout
Route::get('/{any?}', [LayoutController::class, 'index']);
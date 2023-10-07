<?php

use Illuminate\Support\Facades\Route;

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

/*--Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user/add', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user/create/registered', [App\Http\Controllers\UserController::class, 'store'])->name('user.post');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::get('/user/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('user.view');
Route::post('/user/updated', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user/destroy');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('course.index');
Route::get('/courses/add', [App\Http\Controllers\CourseController::class, 'create'])->name('course.create');
Route::post('/courses/create/registered', [App\Http\Controllers\CourseController::class, 'store'])->name('course.post');
Route::get('/courses/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('course.edit');
Route::get('/courses/view/{id}', [App\Http\Controllers\CourseController::class, 'view'])->name('course.view');
Route::post('/courses/updated', [App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
Route::get('/courses/delete', [App\Http\Controllers\CourseController::class, 'delete'])->name('course/destroy');


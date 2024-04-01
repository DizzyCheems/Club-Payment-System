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

Route::get('/tests/main', function () {
    return view('tests/main');
});

Route::get('/tests/auth', function () {
    return view('tests/auth');
});

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]);

Route::middleware(['auth'])->group(function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('/Home', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    
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

Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
Route::get('/students/add', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
Route::post('/students/create/registered', [App\Http\Controllers\StudentController::class, 'store'])->name('student.post');
Route::get('/students/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
Route::get('/students/view/{id}', [App\Http\Controllers\StudentController::class, 'view'])->name('student.view');
Route::post('/students/updated', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::get('/students/delete', [App\Http\Controllers\StudentController::class, 'delete'])->name('student/destroy');

Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
Route::get('/payments/add', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
Route::post('/payments/create/registered', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.post');
Route::get('/payments/edit/{id}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.edit');
Route::get('/payments/view/{id}', [App\Http\Controllers\PaymentController::class, 'view'])->name('payment.view');
Route::post('/payments/updated', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update');
Route::get('/payments/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payment/destroy');

Route::get('/agendas', [App\Http\Controllers\AgendaController::class, 'index'])->name('agenda.index');
Route::get('/agendas/add', [App\Http\Controllers\AgendaController::class, 'create'])->name('agenda.create');
Route::post('/agendas/create/registered', [App\Http\Controllers\AgendaController::class, 'store'])->name('agenda.post');
Route::get('/agendas/edit/{id}', [App\Http\Controllers\AgendaController::class, 'edit'])->name('agenda.edit');
Route::get('/agendas/view/{id}', [App\Http\Controllers\AgendaController::class, 'view'])->name('agenda.view');
Route::post('/agendas/updated', [App\Http\Controllers\AgendaController::class, 'update'])->name('agenda.update');
Route::get('/agendas/delete', [App\Http\Controllers\AgendaController::class, 'delete'])->name('agenda/destroy');

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/tests/main', function () {
    return view('tests/main');
});

Route::get('/tests/auth', function () {
    return view('tests/auth');
});

// Auth routes, disable registration and reset
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]);

Route::middleware(['auth'])->group(function() {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/Home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/Home/Student', [DashboardController::class, 'user'])->name('dashboard.user');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/add/student', [UserController::class, 'create_user'])->name('user.create.student');
    Route::post('/user/create/registered', [UserController::class, 'store_admin'])->name('user.post');
    Route::post('/user/create/registered/user', [UserController::class, 'store_user'])->name('user.post.user');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/view/{id}', [UserController::class, 'view'])->name('user.view');
    Route::post('/user/updated', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete', [UserController::class, 'delete'])->name('user.destroy');
    Route::get('/get-user-info/{id}', [UserController::class, 'getUserInfo']);

    // Admin account edit routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/account', [UserController::class, 'editAdminAccount'])->name('admin.account.edit');
        Route::post('/admin/account/update', [UserController::class, 'updateAdminAccount'])->name('admin.account.update');
    });

    // User Account
    Route::get('/account', [UserController::class, 'account'])->name('user.account');              // view account
    Route::get('/account/edit', [UserController::class, 'editAccount'])->name('user.account.edit'); // edit account
    Route::post('/account/update', [UserController::class, 'updateAccount'])->name('user.account.update'); // update account

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses/add', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses/create/registered', [CourseController::class, 'store'])->name('course.post');
    Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::get('/courses/view/{id}', [CourseController::class, 'view'])->name('course.view');
    Route::post('/courses/updated', [CourseController::class, 'update'])->name('course.update');
    Route::get('/courses/delete', [CourseController::class, 'delete'])->name('course.destroy');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::post('/add/auth', [StudentController::class, 'addstudent_auth'])->name('add.auth'); 
    Route::get('/students/add', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students/create/registered', [StudentController::class, 'store'])->name('student.post');
    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::get('/students/view/{id}', [StudentController::class, 'view'])->name('student.view');
    Route::post('/students/updated', [StudentController::class, 'update'])->name('student.update');
    Route::get('/students/delete', [StudentController::class, 'delete'])->name('student.destroy');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payments/invoice', [PaymentController::class, 'index_invoice'])->name('payment.invoice');
    Route::get('/payments/user', [PaymentController::class, 'index_user'])->name('payment.index.user');
    Route::get('/payments/add', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payments/create/registered', [PaymentController::class, 'store'])->name('payment.post');
    Route::get('/payments/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::get('/payments/view/{id}', [PaymentController::class, 'view'])->name('payment.view');
    Route::get('/payments/invoice/{id}', [PaymentController::class, 'invoice'])->name('payment.invoice');
    Route::post('/payments/updated', [PaymentController::class, 'update'])->name('payment.update');
    Route::get('/payments/delete', [PaymentController::class, 'delete'])->name('payment.destroy');
    Route::post('/update-payments', [PaymentController::class, 'updatePayments'])->name('payment.approve');

    // Agendas
    Route::get('/agendas', [AgendaController::class, 'index'])->name('agenda.index');
    Route::post('/add/agenda/auth', [AgendaController::class, 'addagenda_auth'])->name('agenda.auth'); 
    Route::get('/agendas/add', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agendas/create/registered', [AgendaController::class, 'store'])->name('agenda.post');
    Route::get('/agendas/edit/{id}', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::get('/agendas/view/{id}', [AgendaController::class, 'view'])->name('agenda.view');
    Route::post('/agendas/updated', [AgendaController::class, 'update'])->name('agenda.update');
    Route::get('/agendas/delete', [AgendaController::class, 'delete'])->name('agenda.destroy');
    Route::get('/agenda/{id}/contrib', [AgendaController::class, 'getIndivContrib'])->name('agenda.contrib');

    // Activities
    Route::post('/activity/create/registered', [ActivitiesController::class, 'store'])->name('activity.add');
    Route::get('/activity/delete', [ActivitiesController::class, 'delete'])->name('activity.destroy');

    // Documents
    Route::get('/fileupload/list', [DocumentController::class, 'create'])->name('doc.index');
    Route::post('/fileupload/store', [DocumentController::class, 'store'])->name('fileupload.store');
    Route::get('/file/download/{id}', [DocumentController::class, 'download'])->name('file.download');
    Route::delete('/fileupload/{id}', [DocumentController::class, 'destroy'])->name('file.delete');
    Route::get('/file/preview/{id}', [DocumentController::class, 'preview'])->name('file.preview');

    // Admin account routes
    Route::get('/admin/account/edit', [UserController::class, 'editAdminAccount'])->name('admin.account.edit');
    Route::post('/admin/account/update', [UserController::class, 'updateAdminAccount'])->name('admin.account.update');

});

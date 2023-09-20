<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\RegisteredCoursesController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [PagesController::class, 'index']);


Route::middleware('role:Admin')->group(function(){

    Route::post('/tokens_for_admins', [TokenController::class, 'store'])->name('tokens');
    Route::get('/token', [TokenController::class, 'index'])->name('token');
});

Route::middleware('role:Student')->group(function () {

    Route::post('course/registeration', [HomeController::class, 'store'])->name('studentReg');
    Route::post('home', [HomeController::class, 'storeStudentDetails'])->name('studentDetails');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('home/studentRegister', [App\Http\Controllers\HomeController::class, 'register'])->name('home');
});


Route::middleware('role:Admin')->group(function() {

    Route::get('user_profile/{user}', [AdminPageController::class, 'index'])->name('user_profile');
    Route::get('admin-home/', [AdminPageController::class, 'show'])->name('admin-home');
});

Route::middleware('role:Admin')->group(function() {

    Route::resource('courses', CoursesController::class);
    Route::post('course_acsess', [CoursesController::class, 'storeCourseAccess'])->name('course_access');
});


Route::post('submit', [RegisteredCoursesController::class, 'store'])->name('course_submit');


Auth::routes();
Route::post('registration', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('registration');
Route::get('registeration', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

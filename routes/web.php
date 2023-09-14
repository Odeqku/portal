<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\RegisterController;
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
// dd('ki');
Route::get('/token', [TokenController::class, 'index']);

// dd('ki1');
Route::post('/tokens_for_admins', [TokenController::class, 'store'])->name('tokens');

Route::resource('courses', CoursesController::class);

Route::post('/course/registeration', [HomeController::class, 'store'])->name('studentReg');

Route::post('/home', [HomeController::class, 'storeStudentDetails'])->name('studentDetails');

Route::post('submit', [RegisteredCoursesController::class, 'store'])->name('course_submit');

// Admin Page Management Route
Route::get('user_profile/{user}', [AdminPageController::class, 'index'])->name('user_profile');

Route::get('admin-home/', [AdminPageController::class, 'show'])->name('admin-home');


Auth::routes();
Route::get('registration', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('registration');




Route::get('registeration', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();



Route::get('/home/studentRegister', [App\Http\Controllers\HomeController::class, 'register'])->name('home');

Route::post('course_acsess', [CoursesController::class, 'storeCourseAccess'])->name('course_access');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

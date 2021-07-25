<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AddDonorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Chats\ChatController;
use App\Http\Controllers\User\UserDashboardController;

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

Route::get('/mainlayuots', function () {
    return view('layouts.app');
});

// Routes for public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/donors/search', [HomeController::class, 'search'])->name('search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact');

// Routes for guest
Route::get('/communes/{wilayaName}', [RegisterController::class, 'communes'])->name('communes');
Route::get('/communes/{wilayaName}', [AddDonorController::class, 'communes']);
Route::get('/communes/{wilayaName}', [HomeController::class, 'communes']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register/google', [RegisterController::class, 'registerWithGoogle'])->name('register.google');
Route::get('/register/google/redirect', [RegisterController::class, 'redirectWithGoogle']);
Route::get('/register/facebook', [RegisterController::class, 'registerWithFacebook'])->name('register.facebook');
Route::get('/register/facebook/redirect', [RegisterController::class, 'redirectWithFacebook']);

Route::get('/verification/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::post('/verification/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('/verification/resend', [VerificationController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);
Route::get('/password/confirm', [ConfirmPasswordController::class, 'index'])->name('password.confirm');

// Routes for auth
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/donor/message/{id}', [ChatController::class, 'index'])->name('chat.index');
Route::post('/donor/message', [ChatController::class, 'store'])->name('chat');
Route::get('/donor/message/{id}/{email}', [ChatController::class, 'response']);
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/donor', [UserDashboardController::class, 'showDonor']);
Route::put('/donor', [UserDashboardController::class, 'updateDonor'])->name('updateDonor');
Route::get('/donor/request', [ChatController::class, 'getMessages'])->name('donor.request');
Route::put('/user/settings/information', [UserDashboardController::class, 'information']);
Route::put('/user/settings/password', [UserDashboardController::class, 'passwordUpdate']);

// Routes for admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/donors', [DonorController::class, 'index'])->name('admin.donor');
Route::get('/admin/adonors', [AddDonorController::class, 'index']);
Route::post('/admin/adonors', [AddDonorController::class, 'store'])->name('admin.adonor');
Route::delete('/admin/donor/{id}', [DonorController::class, 'destroy']);
Route::get('/admin/donors/search', [DashboardController::class, 'search'])->name('admin.search');
Route::get('/admin/donors/searchkeyup', [DashboardController::class, 'searchKeyup']);
Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders');
Route::post('/admin/sliders', [SliderController::class, 'store'])->name('admin.slider');
Route::delete('/admin/slider/{id}', [SliderController::class, 'destroy'])->name('slider.delete');
Route::get('/admin/inboxing', [InboxController::class, 'index'])->name('admin.inboxing');
Route::match(['GET', 'PUT'], '/admin/inboxing/{id}', [InboxController::class, 'show'])->name('admin.inbox');
Route::get('/admin/adminstrator', [AdminController::class, 'index']);
Route::post('/admin/adminstrator', [AdminController::class, 'store'])->name('admin.adminstrator');
Route::delete('/admin/adminstrator/{id}', [AdminController::class, 'destroy']);
Route::get('/admin/settings/{id}', [SettingController::class, 'index'])->name('admin.settings');
Route::put('/admin/settings/information/{id}', [SettingController::class, 'information']);
Route::put('/admin/settings/password/{id}', [SettingController::class, 'passwordUpdate']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\AdminRoleRequestController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::get('/role-request/create', [RoleRequestController::class, 'create'])->name('role-request.create');
Route::post('/role-request', [RoleRequestController::class, 'store'])->name('role-request.store');
Route::get('/role-request/my', [RoleRequestController::class, 'myRequests'])->name('role-request.my-requests');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/role-requests', [AdminRoleRequestController::class, 'index'])->name('role-requests.index');
    Route::get('/role-requests/{roleRequest}', [AdminRoleRequestController::class, 'show'])->name('role-requests.show');
    Route::post('/role-requests/{roleRequest}/process', [AdminRoleRequestController::class, 'process'])->name('role-requests.process');
    Route::post('/role-requests/{roleRequest}/comment', [AdminRoleRequestController::class, 'addComment'])->name('role-requests.comment');
    Route::get('/users/{user}', [AdminRoleRequestController::class, 'userProfile'])->name('users.profile');
});

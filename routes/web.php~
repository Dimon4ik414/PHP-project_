<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class, 'index'])->name('Categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('Categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('Categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('Categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('Categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('Categories.destroy');

Route::get('/comments', [CommentController::class, 'index'])->name('Comments.index');
Route::get('/comments/create', [CommentController::class, 'create'])->name('Comments.create');
Route::post('/comments', [CommentController::class, 'store'])->name('Comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('Comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('Comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('Comments.destroy');


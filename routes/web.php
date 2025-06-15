<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/check', function () {
    return ('project is running');
});

//course routes
Route::get('/', [CourseController::class, 'index'])->name('all.courses');
Route::get('/show/{id}', [CourseController::class, 'show'])->name('show.course');
Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');

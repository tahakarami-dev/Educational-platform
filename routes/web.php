<?php

use Illuminate\Support\Facades\Route;


Route::get('/' , \App\Livewire\Front\Home::class)->name('home');
Route::get('/courses' , \App\Livewire\Front\Courses::class)->name('courses');
Route::get('/course' , \App\Livewire\Front\Course::class)->name('course');


Route::get('admin/' , \App\Livewire\Admin\Panel\Index::class)->name('panel');
Route::get('admin/users' , \App\Livewire\Admin\User\UserList::class)->name('users');


<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::get('admin/' , \App\Livewire\Admin\Panel\Index::class)->name('panel');
Route::get('admin/user_create' , \App\Livewire\Admin\User\UserCreate::class)->name('user.create');
Route::get('admin/users' , \App\Livewire\Admin\User\UserList::class)->name('users');


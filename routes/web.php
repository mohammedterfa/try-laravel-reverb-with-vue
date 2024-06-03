<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard', [
        "users" => User::whereNot('id', auth()->id())->get()
    ]);
})->middleware(['auth'])->name('dashboard');


Route::get('/chat/{friend}', function (User $friend) {
    return view('chat', [
        "friend" => $friend
    ]);
})->middleware(['auth'])->name('chat');

require __DIR__.'/auth.php';

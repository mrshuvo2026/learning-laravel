<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-gate', function(){
    if (auth()->user()->can('create-news')){
        return 'permission আছে';
    }
    return 'permission নেই';
})->middleware('auth');

Route::resource('news', NewsController::class)->only([
    'create',
    'store',
    'edit',
    'update',
    'destroy',
])->middleware('auth');

Route::resource('news', NewsController::class)->only([
    'index',
    'show',
]);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/my_user',function(){
     dd(
        auth()->user()->name,
        auth()->user()->email
    );
})->middleware('auth');

Route::get('/check-user', function(){
    return 'Middleware passed';
})->middleware('check.user:admin');

Route::get('/special-page', function () {
    return 'Welcome to Special Page';
})->middleware('check.user:admin');


Route::patch('/notifications/{notification}/read', function ($notification){
    auth()->user()->notifications
    ->findOrFail($notification)
    ->markAsRead();

    return back();
})->middleware('auth')->name('notifications.read');

require __DIR__.'/auth.php';

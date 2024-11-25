<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/key', function() {
    $exitCode = Artisan::call('key:generate');
    return 'DONE'; //Return anything
});

Route::get('/cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

/* ACCOUNT */
// Route::get('/account/create', function(){
//     return view('accountCreate');
// });
Route::post('/account/create', [UserController::class, 'create']);
Route::post('/account/get', [UserController::class, 'get']);

/* LOGIN */
Route::get('/login', function(){
    return redirect('/');
})->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/* PAGES */
Route::get('/', function (){ return view('index')->with('user', userInfo()); });
Route::get('/{channel}', [UserController::class, 'channel'])->middleware('auth');

/* FUNCTIONS */
function userInfo(){
    if (Auth::user())
        return ['name' => Auth::user()['name'], 'id' => Auth::user()['id']];
    else
        return ['name' => 'Guest', 'id' => 0];
}
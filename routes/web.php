<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Character\CharacterController;
use App\http\Controllers\Item\ItemController;
use App\Http\Controllers\PlayerClass\PlayerClassController;
use App\Http\Controllers\Race\RaceController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {return view('welcome');});

//Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//character Routes
Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create');
Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show');
Route::delete('/characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');

// Item Routes
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

// Race Routes
Route::get('/races/create', [RaceController::class, 'create'])->name('races.create');
Route::post('/races', [RaceController::class, 'store'])->name('races.store');
Route::get('/races/{race}', [RaceController::class, 'show'])->name('races.show');
Route::delete('/races/{race}', [RaceController::class, 'destroy'])->name('races.destroy');

// Class Routes
Route::get('/classes/create', [PlayerClassController::class, 'create'])->name('classes.create');
Route::post('/classes', [PlayerClassController::class, 'store'])->name('classes.store');
Route::get('/classes/{playerClass}', [PlayerClassController::class, 'show'])->name('classes.show');
Route::delete('/classes/{playerClass}', [PlayerClassController::class, 'destroy'])->name('classes.destroy');

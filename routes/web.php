<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/series', [SeriesController::class, 'index']);
//Route::get('/series/criar', [SeriesController::class, 'create']);
//Route::post('/series/salvar', [SeriesController::class, 'store']);
//Route::controller(SeriesController::class)->group(function(){
//    Route::get('/series', 'index')->name('series.index');
//    Route::get('/series/criar', 'create')->name('series.create');
//    Route::post('/series/salvar', 'store')->name('series.store');
//});

//Route::resource('/series', SeriesController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
Route::resource('/series', SeriesController::class)->except(['show']);

//Route::post('/series/destroy?id=1', [SeriesController::class, 'destroy']);
//Route::post('/series/destroy/{id}', [SeriesController::class, 'destroy']);
//Route::post('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');

Route::middleware(Autenticador::class)->group(function(){
    Route::get('/', function () {
        return redirect('/series');
    });
    
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
    
    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::name('site.')
     ->group(function () {
         Route::name('home')
              ->get('/', [
                  SiteController::class,
                  'home'
              ]);
     });

Route::name('auth.')
     ->group(function () {
         Route::name('login')
              ->get('/login', [
                  AuthController::class,
                  'login'
              ]);
         Route::name('authenticate')
              ->post('/login', [
                  AuthController::class,
                  'authenticate'
              ]);
     });

Route::prefix('admin')
     ->name('admin.')
     ->middleware('auth')
     ->group(function () {
         Route::name('dashboard')
              ->get('/', [
                  AdminController::class,
                  'dashboard'
              ]);
     });

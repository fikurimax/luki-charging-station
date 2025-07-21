<?php

use App\Http\Controllers\ApiController;
use App\Http\Middleware\Auth as MiddlewareAuth;
use App\Http\Middleware\AuthenticatedUsers;
use App\Livewire\DashboardPage;
use App\Livewire\LandingPage;
use App\Livewire\QrPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthenticatedUsers::class)->get('/', LandingPage::class)->name('login');
Route::middleware(MiddlewareAuth::class)->get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::middleware(MiddlewareAuth::class)->get('/dashboard', DashboardPage::class);
Route::middleware(MiddlewareAuth::class)->get('/qr', QrPage::class);

Route::get('/api/statusmeja', ApiController::class);

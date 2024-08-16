<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    // Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
// });


// Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/area', [AreaController::class, 'index'])->name('area');
    Route::post('/area-store', [AreaController::class, 'store'])->name('area.store');
    Route::get('/area-getdata', [AreaController::class, 'getData'])->name('area.getdata');
    Route::post('/area-change-status', [AreaController::class, 'changeStatus'])->name('area.change.status');
     Route::get('/', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('/ticket-create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('/ticket-list', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('/ticket-getdata', [TicketController::class, 'getData'])->name('ticket.getdata');
    Route::post('/ticket-store', [TicketController::class, 'store'])->name('ticket.store');
    Route::post('/ticket-change-status', [TicketController::class, 'changeStatus'])->name('ticket.change.status');
    Route::post('/ticket-list/filter/', [TicketController::class, 'filter'])->name('ticket.list.filter');
     
    // Route::get('/ticket-list/{id}/', [TicketController::class, 'filter_number'])->name('ticket.list.number');
      Route::get('/ticket-list/{id}/', [TicketController::class, 'filter_number'])->name('ticket.list.number');
    // Route::get('/get-image-url', [TicketController::class, 'getImageUrl'])->name('get.image.url');
    Route::get('/fetch-image/{number}', [TicketController::class, 'fetchImage'])->name('fetch.image');





// });

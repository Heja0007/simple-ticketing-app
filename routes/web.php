<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function () {
    Route::group(['name' => 'tickets'], function () {
        Route::get('/tickets', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/deleted/tickets', [TicketController::class, 'deletedIndex'])->name('admin.ticket.deleted');
        Route::post('restore/ticket/{id}', [TicketController::class, 'restoreTicket'])->name('admin.ticket.restore');
        Route::get('/deleted/tickets', [TicketController::class, 'deletedIndex'])->name('admin.ticket.deleted');
        Route::get('/view/ticket/{id}', [TicketController::class, 'viewTicket'])->name(
            'admin.ticket.view'
        );
        Route::get('/edit/ticket/{id}', [TicketController::class, 'editTicket'])->name(
            'admin.ticket.edit'
        );
        Route::get('/create/ticket', [TicketController::class, 'createTicket'])->name(
            'admin.ticket.create'
        );
        Route::post('/store/ticket', [TicketController::class, 'storeTicket'])->name(
            'admin.ticket.store'
        );
        Route::put('/update/ticket/{id}', [TicketController::class, 'updateTicket'])->name(
            'admin.ticket.update'
        );
        Route::delete('delete/ticket/{id}', [TicketController::class, 'destroy'])->name(
            'admin.ticket.destroy'
        );
    });
});
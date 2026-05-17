<?php
require __DIR__.'/auth.php';

use App\Http\Controllers\ItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::middleware(AdminMiddleware::class . ':admin')->group(function () {

    // display all items
    Route::get('/admin/items', [ItemController::class, 'index'])
        ->name('item.index');

    // show create form
    Route::get('/admin/items/create', [ItemController::class, 'create'])
        ->name('item.create');

    // store item
    Route::post('/admin/items/store', [ItemController::class, 'store'])
        ->name('item.store');

    // show edit form
    Route::get('/admin/items/edit/{id}', [ItemController::class, 'edit'])
        ->name('item.edit');

    // update item
    Route::put('/admin/items/update/{id}', [ItemController::class, 'update'])
        ->name('item.update');

    // delete item
    Route::delete('/admin/items/delete/{id}', [ItemController::class, 'destroy'])
        ->name('item.destroy');

});

Route::middleware(AdminMiddleware::class . ':admin,user')->group(function () {
    Route::get('/', function () {
        return redirect()->route('user.page');
    });

    Route::get('/items', [ItemController::class, 'userIndex'])
        ->name('user.page');
        
    Route::get('/invoice/show', [InvoiceController::class, 'showInvoices'])
        ->name('invoice.show');

    Route::get('/invoice/{id}', [InvoiceController::class, 'index'])
        ->name('invoice.index');

    Route::post('/invoice/store/{id}', [InvoiceController::class, 'store'])
        ->name('invoice.store');

});
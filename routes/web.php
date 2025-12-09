<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SalesRepresentativeController;
use App\Http\Controllers\SalesRepAddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PriceHistoryController;

// Redirect root URL to Teams index
Route::get('/', function () {
    return redirect()->route('teams.index');
});

// Resource routes for entities with single primary keys
Route::resources([
    'teams' => TeamController::class,
    'sales-reps' => SalesRepresentativeController::class,
    'sales-rep-addresses' => SalesRepAddressController::class,
    'customers' => CustomerController::class,
    'customer-addresses' => CustomerAddressController::class,
    'items' => ItemController::class,
    'inventory' => InventoryController::class,
    'orders' => OrderController::class,
]);

// Order Items routes (manual because of composite key: odr_id + itm_number)
Route::get('order-items', [OrderItemController::class, 'index'])->name('order-items.index');
Route::get('order-items/create', [OrderItemController::class, 'create'])->name('order-items.create');
Route::post('order-items', [OrderItemController::class, 'store'])->name('order-items.store');
Route::get('order-items/{odr_id}/{itm_number}/edit', [OrderItemController::class, 'edit'])->name('order-items.edit');
Route::put('order-items/{odr_id}/{itm_number}', [OrderItemController::class, 'update'])->name('order-items.update');
Route::delete('order-items/{odr_id}/{itm_number}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');

// Price History routes (manual because of composite key: itm_number + start_date + start_time)
Route::get('price-history', [PriceHistoryController::class, 'index'])->name('price-history.index');
Route::get('price-history/create', [PriceHistoryController::class, 'create'])->name('price-history.create');
Route::post('price-history', [PriceHistoryController::class, 'store'])->name('price-history.store');
Route::get('price-history/{itm_number}/{start_date}/{start_time}/edit', [PriceHistoryController::class, 'edit'])->name('price-history.edit');
Route::put('price-history/{itm_number}/{start_date}/{start_time}', [PriceHistoryController::class, 'update'])->name('price-history.update');
Route::delete('price-history/{itm_number}/{start_date}/{start_time}', [PriceHistoryController::class, 'destroy'])->name('price-history.destroy');

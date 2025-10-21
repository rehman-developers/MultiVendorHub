<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/preview', [InvoiceController::class, 'preview'])->name('invoice.preview');
Route::post('/get-tax', [InvoiceController::class, 'getTax'])->name('invoice.getTax');
Route::get('/get-sro-list', [InvoiceController::class, 'getSroList'])->name('invoice.getSroList');

Route::get('/test', [InvoiceController::class, 'getSroList']);

Route::get('/get-hs-uom', [InvoiceController::class, 'getHsUom'])->name('invoice.getHsUom');

Route::get('/sync-items', function () {
    App\Jobs\SyncItemsJob::dispatch();
    return 'Items sync job dispatched!';
})->name('sync.items');

Route::get('/sync-uoms', function () {
    $hsCodes = App\Models\Item::pluck('hs_code')->all();
    foreach ($hsCodes as $hsCode) {
        App\Jobs\SyncUomJob::dispatch($hsCode);
    }
    return 'UOM sync jobs dispatched!';
})->name('sync.uoms');
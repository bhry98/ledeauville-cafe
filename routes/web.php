<?php

use App\Models\orders\OrdersModel;
use Illuminate\Support\Facades\Route;

//Route::get('/orders/{order}/print', function (OrdersModel $order) {
Route::get('orders-print-receipt/{order}',function (OrdersModel $order) {
//    dd($order);
    return view('orders-print-receipt', compact('order'));
//    return view('');
})->name('orders-print-receipt');

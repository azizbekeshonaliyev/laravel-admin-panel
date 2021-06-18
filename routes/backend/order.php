<?php

// Order Management
Route::group(['namespace' => 'Order', 'prefix' => 'order'], function () {
    Route::resource('orders', 'OrderController');
});

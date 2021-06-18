<?php

// Partner Management
Route::group(['namespace' => 'Partner', 'prefix' => 'partner'], function () {
    Route::resource('partners', 'PartnerController');
});

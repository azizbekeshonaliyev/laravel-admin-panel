<?php

// Setting Management
Route::group(['namespace' => 'Setting', 'prefix' => 'setting'], function () {
    Route::resource('settings', 'SettingController');
});

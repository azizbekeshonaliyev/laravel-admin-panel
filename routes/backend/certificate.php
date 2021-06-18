<?php

// Partner Management
Route::group(['namespace' => 'Certificate', 'prefix' => 'certificate'], function () {
    Route::resource('certificates', 'CertificateController');
});

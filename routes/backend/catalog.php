<?php

// Catalog Management
Route::group(['namespace' => 'Catalog', 'prefix' => 'catalog'], function () {
    Route::resource('catalog-categories', 'CatalogCategoryController');
    Route::delete('products/{product}/images/{image}/delete', 'ProductController@deleteImage');
    Route::resource('products', 'ProductController');
});

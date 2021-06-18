<?php

// Catalog Categories Management
Route::group(['namespace' => 'Language', 'prefix' => 'language'], function () {
    Route::get('{language}/loadFromFile', 'LanguageController@loadFromFile')->name('languages.loadFromFile');
    Route::get('{language}/writeToFile', 'LanguageController@writeToFile')->name('languages.writeToFile');
    Route::get('{language}/refresh', 'LanguageController@refresh')->name('languages.refresh');
    Route::get('{language}/translationsEdit', 'LanguageController@translationsEdit')->name('languages.translationsEdit');
    Route::get('{language}/getTranslations', 'LanguageController@getTranslations')->name('languages.getTranslations');
    Route::put('{language}/translationsStore', 'LanguageController@translationsStore')->name('languages.translationsStore');
    Route::post('translation/{translation}/update', 'LanguageController@translationUpdate')->name('languages.translationUpdate');
    Route::resource('languages', 'LanguageController');
    Route::resource('translations', 'TranslationController');
});

<?php

// Topic Management
Route::group(['namespace' => 'Topic', 'prefix' => 'topic'], function () {
    Route::resource('topics', 'TopicController');
});

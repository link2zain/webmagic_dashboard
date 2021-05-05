<?php

// Date Dropdown element
Route::get('date-dropdown', [
    'as'   => 'date-dropdown',
    'uses' => 'PresentationController@dateDropdown',
]);

// Date Dropdown element
Route::get('images', [
    'as'   => 'images',
    'uses' => 'PresentationController@imageDisplaying',
]);

// Autoupdate element
Route::get('auto-update', [
    'as'   => 'auto-update',
    'uses' => 'PresentationController@autoUpdate',
]);

// Autocomplete element
Route::get('select-autocomplete', [
    'as'   => 'select-autocomplete',
    'uses' => 'PresentationController@autoComplete',
]);

// Photos uploading plugin
Route::match(['get', 'post', 'delete'], 'photo-uploading', [
    'as'   => 'photo-uploading',
    'uses' => 'PresentationController@photoUploading',
]);

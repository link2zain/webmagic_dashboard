<?php

/** Table page generation full example */
Route::get('table-page', [
    'as'   => 'table-page',
    'uses' => 'PresentationController@tablePage',
]);
Route::get('table-page-description', [
    'as'   => 'table-page-description',
    'uses' => 'PresentationController@tablePageDescription',
]);

/** Tiles list page */
Route::get('tiles-list-page', [
    'as'   => 'tiles-list-page',
    'uses' => 'PresentationController@tilesListPage',
]);
Route::get('tiles-list-page-description', [
    'as'   => 'tiles-list-page-description',
    'uses' => 'PresentationController@tilesListPageDescription',
]);

/** Form page generation full example */
Route::get('form-page', [
    'as'   => 'form-page',
    'uses' => 'PresentationController@formPage',
]);

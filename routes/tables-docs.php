<?php

Route::group([
    'prefix' => 'tables',
    'as' => 'tables.'
], function (){
    Route::get('manual-sorting', [
        'as'   => 'manual-sorting',
        'uses' => 'TablePresentationController@manualSortingDocs',
    ]);

    Route::get('manual-sorting-example', [
        'as'   => 'manual-sorting-example',
        'uses' => 'TablePresentationController@manualSortingExample',
    ]);
});


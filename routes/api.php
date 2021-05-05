<?php

Route::group([
    'prefix'     => 'dashboard/api',
    'as'         => 'dashboard.api.',
    'namespace'  => 'Webmagic\Dashboard\Api\Http',
    'middleware' => config('webmagic.dashboard.dashboard.api_middleware'),
], function () {
    Route::post('image/{field_name}', [
       'as' => 'image.upload',
       'uses' => 'ImagesController@upload'
    ]);

    Route::delete('image', [
        'as' => 'image.delete',
        'uses' => 'ImagesController@delete'
    ]);

});

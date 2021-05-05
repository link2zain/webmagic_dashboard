<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Dashboard title
     |--------------------------------------------------------------------------
     */
    'title' => 'WebMagic Dashboard',

    /*
     |--------------------------------------------------------------------------
     | Dashboard logo configuration
     |--------------------------------------------------------------------------
     */
    'logo' => [
        'link' => '/dashboard',
        'icon' => '/webmagic/dashboard/img/default_logo.png',
        'text' => 'Magic'
    ],

    /*
     |--------------------------------------------------------------------------
     | Menu configuration
     |--------------------------------------------------------------------------
     */
    'menu' => [],

    /*
     |--------------------------------------------------------------------------
     | NavBar menu
     |--------------------------------------------------------------------------
     */
    'header_navigation' => [
        [
            'text' => 'Logout',
            'icon' => '',
            'link' => 'logout',
            'class' => 'nav-item'
        ],
        [
            'text' => 'Preview site',
            'icon' => '',
            'link' => '/',
            'class' => 'nav-item',
            'target' => '_blank'
        ]
    ],

    /*
     |--------------------------------------------------------------------------
     | Default image for preview
     |--------------------------------------------------------------------------
     |
     | You can see the available dashboard components if enabled
     |
     */
    'default_image' =>  '/webmagic/dashboard/img/default-image-png.png',

    /*
     |--------------------------------------------------------------------------
     | Activate dashboard presentation mode
     |--------------------------------------------------------------------------
     |
     | You can see the available dashboard components if enabled
     |
     */
    'presentation_mode' => false,

	/*
     |--------------------------------------------------------------------------
     | Available types of notifications & their icons
     |--------------------------------------------------------------------------
     */
	'available_notification_types' => [
		'info' => 'info',
		'danger' => 'ban',
		'warning' => 'warning',
		'success' => 'check'
	],

    /*
     |--------------------------------------------------------------------------
     | Dashboard API
     |--------------------------------------------------------------------------
     */
    'api_middleware' => ['web', 'auth'],

    /*
     |--------------------------------------------------------------------------
     | Images storage path
     |--------------------------------------------------------------------------
     | Path is related to the public storage directory /storage/app/public/...
     | It available from the front and as /storage/...
     | Public storage symlink should be generated first
     |
     */
    'images_directory' => 'dashboard/images',
];

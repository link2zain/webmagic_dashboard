<?php

Route::group([
    'prefix'     => 'dashboard/tech',
    'as'         => 'dashboard.docs.presentation.',
    'namespace'  => 'Webmagic\Dashboard\Docs\Http',
    'middleware' => ['web'],
], function () {

    // Pages generation examples
    include 'pages-examples.php';

    // Elements generation examples
    include 'elements-examples.php';

    // Tables presentation
    include 'tables-docs.php';

    // JS actions description page
    Route::get('js-actions', [
        'as'   => 'js-actions',
        'uses' => 'PresentationController@jsActions',
    ]);

    // JS actions description page
    Route::get('js-actions/tooltips', [
        'as'   => 'js-actions.tooltips',
        'uses' => 'JSActionsPresentationController@tooltips',
    ]);

    Route::get('js-actions/confirmation-popup', [
        'as'   => 'js-actions.confirmation-popup',
        'uses' => 'JSActionsPresentationController@confirmationPopup',
    ]);

    Route::get('js-actions/content-copy-to-clipboard', [
        'as'   => 'js-actions.content-copy-to-clipboard',
        'uses' => 'JSActionsPresentationController@contentCopyToClipboard',
    ]);

    // Notifications
	Route::get('notifications-description', [
		'as'   => 'notifications-desc',
		'uses' => 'PresentationController@notificationsDescription',
	]);

	// Notifications
	Route::get('notifications', [
		'as'   => 'notifications',
		'uses' => 'PresentationController@notifications',
	]);

    // Play page
    Route::get('play', function (\Webmagic\Dashboard\Dashboard $dashboard) {
       $btn = (new \Webmagic\Dashboard\Elements\Links\LinkButton())->content('Sync with core entries')
           ->js()->sendRequestOnClick()->regular(url()->current(), [], 'GET', true, true, true);

        $dashboard->content($btn);

        return $dashboard;
    });

    Route::get('play/response', [
        'as'   => 'play.response',
        'uses' => function () {

            $data = [
                    'labels' => ['January', 'February', 'March', 'April', 'May'],
                    'datasets' => [
                        [
                            'label'               => 'label-item1 ',
                            'data'                => [28, 48, 40, 27, 40],
                        ],
                        [
                            'backgroundColor'     => '#f56954',
                            'borderColor'         => '#f56954',
                            'label'               =>  'label-item2',
                            'data'                =>  [28, 100, 15, 68, 90],
                        ]
                    ]
                ];

            return json_encode($data);

        },
    ]);

    // Other tech resources rendering
    Route::get('{template}', function ($template, \Webmagic\Dashboard\Dashboard $dashboard) {
        $data = [];

        if ($template == 'all') {
            $allFiles = scandir(__DIR__ . '/../resources/views/tech');
            $data['allFiles'] = $allFiles;
        }

        $template = "dashboard::tech.$template";
        if (view()->exists($template)) {
            $dashboard->content(view($template, $data));

            return $dashboard;
        }

        abort(404);
    });
});

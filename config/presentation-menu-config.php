<?php

return [
    [
        'text' => 'Dashboard details',
        'icon' => 'fa-info',
        'subitems' => [
            [
                'text' => 'Pages',
                'icon' => 'fa-circle',
                'subitems' => [
                    [
                        'link' => 'dashboard/tech/tiles-list-page-description',
                        'text' => 'Tiles list page',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> [
                                'dashboard/tech/tiles-list-page',
                                'dashboard/tech/tiles-list-page-description'
                            ]
                        ]
                    ],
                    [
                        'link' => 'dashboard/tech/form-page',
                        'text' => 'Form Page',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/form-page'
                        ]
                    ],
                ],
            ],
            [
                'text' => 'Table',
                'icon' => 'fa-circle',
                'subitems' => [
                    [
                        'link' => 'dashboard/tech/tables/manual-sorting',
                        'text' => 'Manual sorting',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> [
                                'dashboard/tech/tables/manual-sorting',
                                'dashboard/tech/tables/manual-sorting-example'
                            ]
                        ]
                    ],
                    [
                        'link' => 'dashboard/tech/table-page-description',
                        'text' => 'Table Page',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> [
                                'dashboard/tech/table-page',
                                'dashboard/tech/table-page-description'
                            ]
                        ]
                    ],
                ]
            ],
            [
                'text' => 'Elements',
                'icon' => 'fa-circle',
                'subitems' => [
                    [
                      'link' => 'dashboard/tech/photo-uploading',
                      'text' => 'Photo uploading',
                      'icon' => 'far fa-circle',
                      'active_rules' => [
                          'urls'=> 'dashboard/tech/photo-uploading'
                      ]
                    ],
                    [
                        'link' => 'dashboard/tech/date-dropdown',
                        'text' => 'Date dropdown',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/date-dropdown'
                        ]
                    ],
                    [
                        'link' => 'dashboard/tech/images',
                        'text' => 'Images',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/images'
                        ]
                    ],
                    [
                        'link' => 'dashboard/tech/auto-update',
                        'text' => 'Auto update elements',
                        'icon' => 'far fa-circle',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/auto-update'
                        ]
                    ],
	                [
		                'link' => 'dashboard/tech/notifications-description',
		                'text' => 'Notifications',
		                'icon' => 'far fa-circle',
		                'active_rules' => [
			                'urls'=> [
				                'dashboard/tech/notifications-description',
				                'dashboard/tech/notifications',
			                ]
		                ]
	                ],
                ]
            ],
            [
                'text' => 'JS Actions',
                'icon' => 'fa-circle',
                'subitems' => [
                    [
                        'text' => 'Overview',
                        'icon' => 'far fa-circle',
                        'link' => 'dashboard/tech/js-actions',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/js-actions'
                        ]
                    ],
                    [
                        'text' => 'Confirmation popup',
                        'icon' => 'far fa-circle',
                        'link' => 'dashboard/tech/js-actions/confirmation-popup',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/js-actions/confirmation-popup'
                        ]
                    ],
                    [
                        'text' => 'Tooltips',
                        'icon' => 'far fa-circle',
                        'link' => 'dashboard/tech/js-actions/tooltips',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/js-actions/tooltips'
                        ]
                    ],
                    [
                        'text' => 'Content copy',
                        'icon' => 'far fa-circle',
                        'link' => 'dashboard/tech/js-actions/content-copy-to-clipboard',
                        'active_rules' => [
                            'urls'=> 'dashboard/tech/js-actions/content-copy-to-clipboard'
                        ]
                    ],
                ]
            ],

        ],
    ],
];

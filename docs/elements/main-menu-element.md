# Main Menu Element
For use main menu you should use special component `Webmagic\Dashboard\Components\Menus\MainMenu\MainMenu`
As menu items you can use `Webmagic\Dashboard\Components\Menus\MainMenu\Item`
Menu has no content block. You can only add item into that.

Menu Item has next content block:
```php
$available_fields = [
        'text',
        'class',
        'link',
        'icon',
        'rank',
        'gates'
    ];
```

#### Structure of setup menu

- text  - Default is text. 
- icon - As icon you can use any icon form available in AdminLTE fonts - https://adminlte.io/themes/AdminLTE/pages/UI/icons.html
- rank - parameter need for sort show menu (priority which will be first)
- link - link where will be direct
- gates - Array of gates (https://laravel.com/docs/5.5/authorization#gates)
- subitems - Array of subitems
- active_rules - Array of rules when item/subitem will be active
  
#### Gates
You can pass into attribute 'gates' names of your registered gates and if will be at least one true this item will be
show in other case no. About gates - https://laravel.com/docs/5.5/authorization#gates

Example pass:
  ```php
            'text' => 'Level 1',
            'icon' => '',
            'link' => url('dashboard'),
            'gates' => ['admin', 'manager', 'guest']
            'active_rules' => [
                'urls' => [
                    'dashboard'
                ],
            ],
```

You can set up MainMenu just pass an array with next structure:
```php
'menu' => [
        [
            'text' => 'Level 1',
            'icon' => '',
            'link' => url('dashboard'),
            'gates' => ['admin'],
            'active_rules' => [
                'urls' => [
                    'dashboard'
                ],
            ],
            'subitems' => [
                [
                    'text' => 'level 2',
                    'icon' => 'fa-book',
                    'link' => url('/'),
                    'subitems' => [
                        [
                            'text' => 'level 3',
                            'icon' => 'fa-book',
                            'link' => url('dashboard/some'),
                            'rank' => 800,
                            'active_rules' => [
                                'urls' => [
                                    'dashboard/some'
                                ],
                            'url_reg_exps' => [
                                    'dashboard\/some\/.*\/edit'
                                ]
                            ],
                        ],
                        [
                            'text' => 'level 3 second time',
                            'icon' => 'fa-book',
                            'link' => url('dashboard/test2'),
                            'rank' => 900,
                            'active_rules' => [
                                'routes'=>[
                                    'tech::test',
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'text' => 'Level 1(second)',
            'icon' => 'fa-book',
            'link' => url('dashboard/test'),
            'rank' => 200,
            'active_rules' => [
                'routes_parts'=>[
                    'tech::',
                    'another::'
                ],
            ]
        ]
    ]

$main_menu = new \Webmagic\Dashboard\Components\Menus\MainMenu\MainMenu($menu_items);

```

**Every item/sub_item should be array** . For set sub_item - declare  'subitems' key and pass array with arrays of itmes. Depth of sub items are not limited.

Also you can set in dashboard_config in menu_items_config array and it will be set up from this array.

active_rules - array conditions when item will set as active it can include the next :

 - routes_parts - will be look for matches with current route NAME with and values in routes_parts array. Values can be any. Can be part of route or name of group doesn't matter.
 - routes - will be compare current route NAME with values in array routes. Values can be only NAMES of route.
 - urls - will be compare current route with values in urls. Values can be only PATH without domain like - 'dashboard/products'

active_rules you can set in array Item or by function
 ```php
$item->addRules([
    'routes_parts' => [
        'dashboard::'
    ],
    'routes' => [
        'filter-page'
    ],
    'urls' => [
        'dashboard/test'
    ],
    'url_reg_exps' => [ 'url_reg_exps' => [
        'dashboard\/some\/.*\/edit'
    ]
        'dashboard\/some\/.*\/edit'
    ]
]);
```

Also you can set sub item for any item. Depth of sub items are not limited.
You can use few methods for management activity of item

```php
    //create new menu
    $main_menu = new \Webmagic\Dashboard\Components\Menus\MainMenu\MainMenu();
    
    //create item
    $menu_regular_item = new \Webmagic\Dashboard\Components\Menus\MainMenu\Item([
        'text' => 'Regular item',
        'icon' => 'fa-book',
        'link' => url('/'),
        'rank' => 200
    ]);
    
    //add item to menu
    $main_menu->addItem($menu_regular_item);

    //create item
    $menu_tree = new \Webmagic\Dashboard\Components\Menus\MainMenu\Item([
        'text' => 'Tree item',
        'icon' => 'fa-book',
        'link' => url('/')
    ]);
    
    //set items as sub item
    $menu_regular_item->addSubItem($menu_regular_item);
    $menu_regular_item->addSubItem($menu_regular_item);
    $menu_regular_item->addSubItem($menu_regular_item);
    $menu_regular_item->addSubItem($menu_regular_item);
    $menu_tree->addSubItem($menu_regular_item);
    
    //set item as active
    $menu_tree->setActive();
   
    //add item to menu
    $main_menu->addItem($menu_tree);
    
    //put menu in page content block
    $page->setFieldContent($main_menu, 'main_sidebar');
```

You will see - http://joxi.ru/Dr84LKVHkKeMEr
And you will have many sub items. Depth of sub items not limited

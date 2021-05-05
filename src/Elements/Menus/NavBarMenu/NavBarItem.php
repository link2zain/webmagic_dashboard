<?php

namespace Webmagic\Dashboard\Elements\Menus\NavBarMenu;

use Webmagic\Dashboard\Elements\Menus\MenuItem;

class NavBarItem extends MenuItem
{
    protected $view = 'dashboard::components.menus.navbar_menu.item';

    protected $available_fields = [
        'text',
        'class',
        'link',
        'icon',
        'rank',
        'gates',
        'target'
    ];

    public function __construct($content = null)
    {
        parent::__construct($content);
    }
}

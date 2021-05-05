<?php

namespace Webmagic\Dashboard\Elements\Menus\NavBarMenu;

use Webmagic\Dashboard\Elements\Menus\MainMenu\MainMenu;

class NavBarMenu extends MainMenu
{
    /** @var string View */
    protected $view = 'dashboard::components.menus.navbar_menu.menu';

    protected $itemClass = NavBarItem::class;

    public function __construct($items_array = null)
    {
        parent::__construct($items_array);
    }
}

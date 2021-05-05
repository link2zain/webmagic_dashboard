<?php

namespace Webmagic\Dashboard\Elements\Buttons\ButtonGroup;

use Webmagic\Dashboard\Elements\Links\Link;

class ButtonGroupLink extends Link
{
    protected $view = 'dashboard::elements.buttons.button_group.button_group_link';

    protected $available_fields = [
        'content',
        'link',
        'classes'
    ];
}

<?php

namespace Webmagic\Dashboard\Elements\Buttons\ButtonGroup;

use Webmagic\Dashboard\Core\ComplexElement;

class ButtonGroupDivider extends ComplexElement
{
    protected $view = 'dashboard::elements.buttons.button_group.button_group_divider';

    protected $available_fields = [
        'class'
    ];

    protected $default_field = 'class';
}

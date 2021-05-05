<?php


namespace Webmagic\Dashboard\Elements\Buttons\ButtonSwitch;

use Webmagic\Dashboard\Core\ComplexElement;

class DefaultButtonSwitch extends ComplexElement
{
    protected $view = 'dashboard::elements.forms.elements.switch';

    protected $available_fields = [
        'class',
        'color',
        'name',
        'value',
        'size',
        'text',
    ];

    protected $default_field = 'content';
}

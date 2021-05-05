<?php


namespace Webmagic\Dashboard\Elements\Buttons\ButtonLink;

use Webmagic\Dashboard\Core\ComplexElement;

class DefaultButtonLink extends ComplexElement
{
    protected $view = 'dashboard::elements.buttons.button_link';

    protected $available_fields = [
        'content',
        'class' => [
            'default' => 'btn-primary'
        ],
        'iconFirst',
        'iconLast',
//        'name'
    ];

    protected $default_field = 'content';
}

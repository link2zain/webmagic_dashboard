<?php


namespace Webmagic\Dashboard\Elements\Special;

use Webmagic\Dashboard\Core\ComplexElement;

class LogoLinkElement extends ComplexElement
{
    protected $view = 'dashboard::elements.special.logo_link';

    protected $available_fields = [
        'link',
        'icon',
        'text'
    ];

    protected $default_field = 'text';
}

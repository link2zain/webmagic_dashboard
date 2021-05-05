<?php


namespace Webmagic\Dashboard\Elements;

use Webmagic\Dashboard\Core\ComplexElement;

class Image extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.image';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'class',
        'src',
        'alt'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'src';
}

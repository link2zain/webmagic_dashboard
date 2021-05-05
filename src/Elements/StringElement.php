<?php


namespace Webmagic\Dashboard\Elements;


use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\StringElement content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\StringElement addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\StringElement class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\StringElement addClass($valueOrConfig)
 *
 ********************************************************************************************************************/

class StringElement extends ComplexElement
{
    protected $view = 'dashboard::elements.string_element';

    protected $available_fields = [
        'content',
        'class'
    ];

    protected $default_field = 'content';
}

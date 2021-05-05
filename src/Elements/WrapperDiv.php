<?php


namespace Webmagic\Dashboard\Elements;


use Webmagic\Dashboard\Core\ComplexElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\WrapperDiv content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\WrapperDiv addContent($valueOrConfig)
 *
 ********************************************************************************************************************/

class WrapperDiv extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.div';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'content'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'content';
}

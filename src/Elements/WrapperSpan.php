<?php


namespace Webmagic\Dashboard\Elements;


use Webmagic\Dashboard\Core\ComplexElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\WrapperSpan content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\WrapperSpan addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\WrapperSpan icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\WrapperSpan addIcon($valueOrConfig)
 *
 ********************************************************************************************************************/

class WrapperSpan extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.span';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'content',
        'icon'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'content';
}

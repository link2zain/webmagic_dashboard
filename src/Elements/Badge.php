<?php


namespace Webmagic\Dashboard\Elements;


use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Badge class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Badge addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Badge content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Badge addContent($valueOrConfig)
 *
 ********************************************************************************************************************/

class Badge extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.badge';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'class',
        'content'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'content';
}

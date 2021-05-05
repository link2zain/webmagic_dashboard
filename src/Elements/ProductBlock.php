<?php


namespace Webmagic\Dashboard\Elements;


use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\ProductBlock name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\ProductBlock addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\ProductBlock img($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\ProductBlock addImg($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\ProductBlock link($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\ProductBlock addLink($valueOrConfig)
 *
 ********************************************************************************************************************/

class ProductBlock extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.product_block';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'name',
        'img',
        'link'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'name';
}

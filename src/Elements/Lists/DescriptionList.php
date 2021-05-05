<?php

namespace Webmagic\Dashboard\Elements\Lists;


use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Elements\StringElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Lists\DescriptionList isHorizontal(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Lists\DescriptionList addIsHorizontal(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Lists\DescriptionList data(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Lists\DescriptionList addData(array $valueOrConfig)
 *
 ********************************************************************************************************************/

class DescriptionList extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.lists.description_list';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'is_horizontal' => [
            'type'    => 'bool',
            'default' => false,
        ],
        'data'          => [
            'type'    => 'array',
            'default' => [],
            'array_acceptable' => true
        ],
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'data';
}

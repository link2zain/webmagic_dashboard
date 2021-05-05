<?php

namespace Webmagic\Dashboard\Elements\Lists;


use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Elements\StringElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Lists\DataList data(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Lists\DataList addData(array $valueOrConfig)
 *
 ********************************************************************************************************************/

class DataList extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.lists.description-block';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'data'          => [
            'type'    => 'array',
            'default' => [],
        ],
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'data';
}
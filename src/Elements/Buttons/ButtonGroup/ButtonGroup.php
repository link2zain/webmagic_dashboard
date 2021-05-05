<?php

namespace Webmagic\Dashboard\Elements\Buttons\ButtonGroup;

use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup buttonClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addButtonClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup link($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addLink($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addIcon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup items(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup addItems(array $valueOrConfig)
 *
 ********************************************************************************************************************/

class ButtonGroup extends ComplexElement
{
    protected $view = 'dashboard::elements.buttons.button_group.button_group';

    protected $available_fields = [
        'class',
        'button_class' => [
            'default' => 'btn-info'
        ],
        'link',
        'content',
        'icon',
        'items' => [
            'type' => 'array',
            'default' => []
        ]
    ];

    protected $default_field = 'content';
}

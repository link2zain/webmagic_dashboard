<?php


namespace Webmagic\Dashboard\Elements\Buttons;

use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton addIcon($valueOrConfig)
 *
 ********************************************************************************************************************/

class DefaultButton extends ComplexElement
{
    protected $view = 'dashboard::elements.buttons.button';

    protected $available_fields = [
        'type' => [
            'default' => 'button',
        ],
        'content',
        'class' => [
            'default' => 'btn-primary'
        ],
        'icon'
    ];

    protected $default_field = 'content';
}

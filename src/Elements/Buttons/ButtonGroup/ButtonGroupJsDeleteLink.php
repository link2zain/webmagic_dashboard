<?php

namespace Webmagic\Dashboard\Elements\Buttons\ButtonGroup;

use Webmagic\Dashboard\Elements\Links\Link;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink link($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addLink($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink classes($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addClasses($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink itemClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addItemClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink requestUri($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addRequestUri($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink method($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink addMethod($valueOrConfig)
 *
 ********************************************************************************************************************/

class ButtonGroupJsDeleteLink extends Link
{
    protected $view = 'dashboard::elements.buttons.button_group.button_group_js_delete';


    protected $available_fields = [
        'content',
        'link',
        'classes' => [
          'default' => 'js_delete'
        ],
        'item_class',
        'request_uri',
        'method' => [
            'default' => 'POST'
        ]
    ];
}

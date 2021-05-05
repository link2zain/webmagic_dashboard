<?php


namespace Webmagic\Dashboard\Elements\Links;

use Webmagic\Dashboard\Core\Content\JsActionsApplicable;
use Webmagic\Dashboard\JsActions\JsActionsCollection;
use Webmagic\Dashboard\JsActions\ModalActions;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton link($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton addLink($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton addIcon($valueOrConfig)
 *
 ********************************************************************************************************************/

class LinkButton extends Link implements JsActionsApplicable
{
    protected $view = 'dashboard::elements.links.link_button';

    protected $available_fields = [
        'content',
        'link',
        'class' => [
          'default' => 'btn-info'
        ],
        'icon'
    ];

    protected $default_field = 'content';
}

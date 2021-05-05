<?php


namespace Webmagic\Dashboard\Elements\Links;


use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\ElementsCreateAbleContract;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method LinkJSDelete content($valueOrConfig)
 * @method LinkJSDelete addContent($valueOrConfig)
 * @method LinkJSDelete link($valueOrConfig)
 * @method LinkJSDelete addLink($valueOrConfig)
 * @method LinkJSDelete classes($valueOrConfig)
 * @method LinkJSDelete addClasses($valueOrConfig)
 * @method LinkJSDelete icon($valueOrConfig)
 * @method LinkJSDelete addIcon($valueOrConfig)
 * @method LinkJSDelete itemClass($valueOrConfig)
 * @method LinkJSDelete addItemClass($valueOrConfig)
 * @method LinkJSDelete requestUri($valueOrConfig)
 * @method LinkJSDelete addRequestUri($valueOrConfig)
 * @method LinkJSDelete method($valueOrConfig)
 * @method LinkJSDelete addMethod($valueOrConfig)
 *
 ********************************************************************************************************************/

class LinkJSDelete extends ComplexElement
{
    protected $view = 'dashboard::elements.links.link_js_delete_button';

    protected $available_fields = [
        'content',
        'link',
        'classes' => [
            'default' => 'btn-info'
        ],
        'icon',
        'item_class',
        'request_uri',
        'method' => [
            'default' => 'POST'
        ]
    ];

    protected $default_field = 'content';

    /**
     * @param string $title
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function setModalTitle(string $title)
    {
        return $this->attr('data-delete-modal-ttl', $title);
    }

    /**
     * @param string $content
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function setModalContent(string $content)
    {
        return $this->attr('data-delete-modal-cnt', $content);
    }
}

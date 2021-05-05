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
 * @method Link content($valueOrConfig)
 * @method Link addContent($valueOrConfig)
 * @method Link link($valueOrConfig)
 * @method Link addLink($valueOrConfig)
 *
 ********************************************************************************************************************/

class Link extends ComplexElement
{
    protected $view = 'dashboard::elements.links.link';

    protected $available_fields = [
        'content',
        'link'
    ];

    protected $default_field = 'content';

    /**
     * @param null $value
     *
     * @return string
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     * @deprecated  Will be removed in future major update
     */
    public function classes($value = null)
    {
        if($value){
            return $this->updateClass($value);
        }

        return $this->classAsString();
    }

    /**
     * @param $value
     *
     * @return mixed
     * @deprecated Will be removed in future major update
     */
    public function addClasses($value)
    {
        return $this->addClass($value);
    }

    /**
     * Add attribute to open link in new window
     *
     * @param bool $on
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null|Link
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function inNewTab(bool $on = true)
    {
        if($on){
            return $this->attr('target', '_blank');
        }

        return $this->attr('target', '_self');
    }
}

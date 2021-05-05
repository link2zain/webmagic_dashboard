<?php


namespace Webmagic\Dashboard\Elements\Icons;


use Webmagic\Dashboard\Core\ComplexElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Icons\Icon icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon addIcon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon classes($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon addClasses($valueOrConfig)
 *
 ********************************************************************************************************************/

class Icon extends ComplexElement
{
    protected $view = 'dashboard::elements.icons.icon';

    protected $available_fields = [
        'icon',
        'title',
        'classes'
    ];

    protected $default_field = 'icon';

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed|Icon
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __call($name, $arguments)
    {
        if(strpos($name, 'fa') === 0){
            return $this->icon(str_replace('_', '-', snake_case($name)));
        }

        return parent::__call($name, $arguments);
    }


}

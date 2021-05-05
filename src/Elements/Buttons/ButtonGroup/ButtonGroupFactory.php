<?php


namespace Webmagic\Dashboard\Elements\Buttons\ButtonGroup;

class ButtonGroupFactory
{

    /**
     * Create button group
     *
     * @param null $param
     * @return ButtonGroup
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function look($param = null)
    {
        $default = [
            'class',
            'button_class' => 'bg-teal',
            'content' =>  'Просмотреть',
            'icon' =>  'fas fa-eye',
            'items'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new ButtonGroup($arg);
    }

    /**
     * Create button group
     *
     * @param null $param
     * @return ButtonGroup
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function lookRight($param = null)
    {
        $default = [
            'class' => 'float-right',
            'button_class' => 'bg-teal',
            'content' =>  'Просмотреть',
            'icon' =>  'fas fa-eye',
            'items'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new ButtonGroup($arg);
    }
}

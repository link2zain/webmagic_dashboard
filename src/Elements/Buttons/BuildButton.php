<?php


namespace Webmagic\Dashboard\Elements\Buttons;

class BuildButton
{
    /**
     * Create button
     *
     * @param null $param
     * @return DefaultButton
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function change($param = null)
    {
        $default = [
            'content'  => 'Внести изменения',
            'class' => 'btn-primary',
            'icon'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButton($arg);
    }

    /**
     * Create button
     *
     * @param null $param
     * @return DefaultButton
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function copy($param = null)
    {
        $default = [
            'content'  => 'Копировать',
            'class' => 'btn-sm bg-teal',
            'icon'  => 'fas fa-copy'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButton($arg);
    }

    /**
     * Create button
     *
     * @param null $param
     * @return DefaultButton
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function newProduct($param = null)
    {
        $default = [
            'content'  => 'Новый товар',
            'class' => 'bg-teal btn-sm',
            'icon'  => 'fas fa-plus'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButton($arg);
    }
}

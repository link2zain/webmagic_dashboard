<?php


namespace Webmagic\Dashboard\Elements\Buttons\ButtonLink;

class BuildButtonLink
{
    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function addPage($param = null)
    {
        $default = [
            'content' => 'Добавить новую страницу',
            'class' => 'text-green',
            'iconFirst' => 'fas fa-plus',
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function changeView($param = null)
    {
        $default = [
            'content' => 'Change of view',
            'class' => 'text-light-blue',
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function comment($param = null)
    {
        $default = [
            'content' => 'Comment',
            'class' => 'text-light-blue',
            'iconFirst' =>  'fas fa-plus'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function create($param = null)
    {
        $default = [
            'content' => 'Создать',
            'class' => 'text-green',
            'iconFirst' =>  'fas fa-check'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function delete($param = null)
    {
        $default = [
            'content' => 'Delete',
            'class' => 'text-red',
            'iconFirst' =>  'fas fa-close'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function done($param = null)
    {
        $default = [
            'content' => 'Done',
            'class' => 'text-light-blue',
            'iconFirst' =>  'fas fa-check'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function edit($param = null)
    {
        $default = [
            'content' => 'Edit',
            'class' => 'text-light-blue',
            'iconFirst' =>  'fas fa-pencil'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function editField($param = null)
    {
        $default = [
            'content' => 'Изменить поля',
            'class' => 'text-light-blue',
            'iconFirst' =>  'fas fa-sort'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     * Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function name($param = null)
    {
        // to do
        $default = [
            'content' => 'Name ',
            'class' => 'text-light-blue margin-r-5',
            'iconFirst' =>  'fas fa-plus',
            'iconLast' => 'fas fa-stop text-green js-color-pick colorpicker-element'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function view($param = null)
    {
        $default = [
            'content' => 'View',
            'class' => 'text-purple',
            'iconFirst' =>  'fas fa-eye'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link without content
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function cog($param = null)
    {
        $default = [
            'class' => 'link-black',
            'iconFirst' =>  'fas fa-cog'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link without content
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function file($param = null)
    {
        $default = [
            'class' => 'text-green',
            'iconFirst' =>  'fas fa-file'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }


    /**
     *  Create button link without content
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function pencil($param = null)
    {
        $default = [
            'class' => 'text-blue',
            'iconFirst' =>  'fas fa-pencil'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link with default size
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function closeSizeNormal($param = null)
    {
        $default = [
            'class' => 'text-red',
            'iconFirst' =>  'fas fa-close'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link with large size
     *  set class="btn-lg"
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function closeSizeLarge($param = null)
    {
        $default = [
            'class' => 'text-red btn-lg',
            'iconFirst' =>  'fas fa-close'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }

    /**
     *  Create button link with small size
     *  set class="btn-sm"
     *
     * @param null $param
     * @return DefaultButtonLink
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function closeSizeSmall($param = null)
    {
        $default = [
            'class' => 'text-red btn-sm',
            'iconFirst' =>  'fas fa-close'
        ];
        $arg =  isset($param) ? array_merge($default, $param) : $default;

        return new DefaultButtonLink($arg);
    }
}

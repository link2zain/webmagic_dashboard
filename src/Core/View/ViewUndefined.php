<?php


namespace Webmagic\Dashboard\Core\View;

class ViewUndefined extends \Exception
{

    /**
     * ViewUndefined constructor.
     *
     * @param $page
     */
    public function __construct($page)
    {
        $class_name = get_class($page);
        $message = "View is undefined in $class_name";
        parent::__construct($message);
    }
}

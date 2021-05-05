<?php


namespace Webmagic\Dashboard\Core\Content\Exceptions;

use Webmagic\Dashboard\Pages\Page;

class NoOneFieldsWereDefined extends \Exception
{
    /**
     * NoOneFieldWereDefined constructor.
     *
     * @param Page $object
     */
    public function __construct($object)
    {
        $className = get_class($object);
        $message = "No one field was defined in $className" ;
        parent::__construct($message);
    }
}

<?php


namespace Webmagic\Dashboard\Core\Content\Exceptions;

class UnacceptableValueException extends \Exception
{

    /**
     * UnacceptableValueException constructor.
     *
     * @param $value
     * @param $name
     * @param $class
     */
    public function __construct($value, $name, $class)
    {
        $message = "Value $value is unacceptable for field $name in $class";

        parent::__construct($message);
    }
}

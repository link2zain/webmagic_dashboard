<?php


namespace Webmagic\Dashboard\Core\Content\Exceptions;

class FieldNotValidException extends \Exception
{
    public function __construct($fieldName, $realType, $neededType, $class)
    {
        $message = "Field $fieldName should be $neededType, but " . $realType . " given in " . $class;

        parent::__construct($message);
    }
}

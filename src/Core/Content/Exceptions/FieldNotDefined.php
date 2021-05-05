<?php


namespace Webmagic\Dashboard\Core\Content\Exceptions;

class FieldNotDefined extends \Exception
{
    /**
     * SectionNotDefined constructor.
     *
     * @param string $fieldName
     * @param        $object
     */
    public function __construct(string $fieldName, $object)
    {
        $class = get_class($object);
        $message = "Field $fieldName undefined in $class";

        parent::__construct($message);
    }
}

<?php


namespace Webmagic\Dashboard\Core\Content\Exceptions;

class ContentTypeException extends \Exception
{
    /**
     * ContentTypeException constructor.
     *
     */
    public function __construct()
    {
        $message = "Content must be a string or implement Renderable interface";

        parent::__construct($message);
    }
}

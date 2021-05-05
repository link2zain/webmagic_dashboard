<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;


use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

class ClearButton extends Input
{

    /**
     * Input constructor.
     *
     * @param null $content
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        $this->attr('type', 'reset');
    }
}

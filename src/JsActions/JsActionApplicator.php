<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

abstract class JsActionApplicator
{
    /** @var JsActionsApplicable */
    protected $element;

    /**
     * JsActionApplicator constructor.
     *
     * @param JsActionsApplicable $element
     */
    public function __construct(JsActionsApplicable $element)
    {
        $this->element = $element;
    }
}

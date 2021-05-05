<?php


namespace Webmagic\Dashboard\Core\Content;


use Webmagic\Dashboard\JsActions\JsActionsCollection;

trait JsActionsApplicableTrait
{
    /**
     * @return JsActionsCollection
     */
    public function js(): JsActionsCollection
    {
        return new JsActionsCollection($this);
    }
}

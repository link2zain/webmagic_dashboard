<?php

namespace Webmagic\Dashboard\Core\Content;


use Webmagic\Dashboard\JsActions\JsActionsCollection;

interface JsActionsApplicable extends ClassAvailable, AttributesAvailable
{
    /**
     * Start js action applaying
     *
     * @return JsActionsCollection
     */
    public function js(): JsActionsCollection;
}

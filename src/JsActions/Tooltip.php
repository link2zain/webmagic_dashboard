<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class Tooltip extends JsActionApplicator
{
    /**
     * Add tooltip to element
     *
     * @param string $description
     *
     * @return JsActionsApplicable
     */
    public function regular(string $description)
    {
        $this->element->attr('title', $description);

        return $this->element;
    }

    /**
     * Hide tooltip
     *
     * @return JsActionsApplicable
     */
    public function hide()
    {
        $this->element->addClass('js_hide-tooltip');

        return $this->element;
    }
}

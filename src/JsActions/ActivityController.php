<?php


namespace Webmagic\Dashboard\JsActions;

use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class ActivityController extends JsActionApplicator
{

    /**
     * ActivityController constructor.
     *
     * @param JsActionsApplicable $element
     */
    public function __construct(JsActionsApplicable $element)
    {
        parent::__construct($element);

        $this->addClass();
    }

    /**
     * Add initial class
     */
    protected function addClass()
    {
        $this->element->addClass('js_control-state');
    }

    /**
     * Add possibility to control "disable" attribute by action with any other active element
     * (any input, checkbox, radiobutton, select, textarea, etc)
     *
     * @param string $controlElIdentifier
     * @param bool   $statusForEmpty
     *
     * @return JsActionsApplicable
     */
    public function addDisabilityController(string $controlElIdentifier, bool $statusForEmpty = true)
    {
        $this->element->attrs([
            'data-control-state' => 'disable',
        ]);

        return $this->applyBasicOptions($controlElIdentifier, $statusForEmpty);
    }

    /**
     * Add possibility to control the element visibility by action with any other active element
     * (any input, checkbox, radiobutton, select, textarea, etc)
     *
     * @param string $controlElIdentifier
     * @param bool   $statusForEmpty
     *
     * @return JsActionsApplicable
     */
    public function addVisibilityController(string $controlElIdentifier, bool $statusForEmpty = true)
    {
        $this->element->attrs([
            'data-control-state' => 'hidden',
        ]);

        return $this->applyBasicOptions($controlElIdentifier, $statusForEmpty);
    }

    /**
     * Set basic options
     *
     * @param string $controlElIdentifier
     * @param bool   $statusForEmpty
     *
     * @return JsActionsApplicable
     */
    protected function applyBasicOptions(string $controlElIdentifier, bool $statusForEmpty)
    {
        $this->element
            ->addClass('js_control-state')
            ->attrs([
                'data-control-el' => $controlElIdentifier,
                'data-state-active-by-empty' => $statusForEmpty
            ]);

        return $this->element;
    }
}

<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class ContentCopy extends JsActionApplicator
{
    /** @var string */
    protected $actionClass = 'js_copy-cnt';

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
        $this->element->addClass($this->actionClass);
    }

    /**
     *
     * getCurrentElementAttrToClipboard
     *
     * @param string $willBeCopyToClipboard
     * that will be copied to clipboard from attribute of current element
     *
     * @return JsActionsApplicable $element
     *
     * */
    public function getCurrentElementAttrToClipboard(string $willBeCopyToClipboard)
    {
        $this->element->attrs([
            'data-copy' => $willBeCopyToClipboard,
        ]);

        return $this->element;
    }

    /**
     * getElementValueToClipboard
     * get value of element to clipboard
     *
     * @param string $classOrId
     * identifier of DOM element
     *
     * @return JsActionsApplicable $element
     *
     */
    public function getElementValueToClipboard(string $classOrId)
    {

        $this->element->attrs([
            'data-el' => $classOrId,
        ]);

        return $this->element;
    }
}

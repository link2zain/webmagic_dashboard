<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class OpenInModalOnClick extends JsActionApplicator
{
    /** @var string */
    protected $actionClass = 'js_ajax-by-click-btn';

    /**
     * Apply the regular action
     *
     * @param string $action
     * @param string $method
     * @param string $title
     * @param string $modalSize
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function regular(
        string $action,
        string $method = 'POST',
        string $title = '',
        string $modalSize = '',
        bool $reloadOnClose = false
    ): JsActionsApplicable {
        $element = (new ModalActions($this->element))->regular($title, $modalSize, $reloadOnClose);

        return $this->applyBasicAttributes($element, $action, $method);
    }

    /**
     *
     *
     * @param string $action
     * @param string $method
     * @param string $title
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function smallModal(
        string $action,
        string $method = 'POST',
        string $title = '',
        bool $reloadOnClose = false
    ): JsActionsApplicable {
        $element = (new ModalActions($this->element))->small($title, $reloadOnClose);

        return $this->applyBasicAttributes($element, $action, $method);
    }

    /**
     *
     *
     * @param string $action
     * @param string $method
     * @param string $title
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function bigModal(
        string $action,
        string $method = 'POST',
        string $title = '',
        bool $reloadOnClose = false
    ): JsActionsApplicable {
        $element = (new ModalActions($this->element))->big($title, $reloadOnClose);

        return $this->applyBasicAttributes($element, $action, $method);
    }

    /**
     * Basic configuration
     *
     * @param JsActionsApplicable $element
     * @param string              $action
     * @param string              $method
     *
     * @return JsActionsApplicable
     */
    protected function applyBasicAttributes(JsActionsApplicable $element, string $action, string $method)
    {
        $element->attrs([
            'data-action'      => $action,
            'data-method'      => $method,
            'data-success-msg' => false,
        ])
            ->addClass($this->actionClass);

        return $element;
    }
}

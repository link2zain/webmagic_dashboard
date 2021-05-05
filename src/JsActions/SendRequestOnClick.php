<?php


namespace Webmagic\Dashboard\JsActions;

use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class SendRequestOnClick extends JsActionApplicator
{
    /** @var string  */
    protected $actionClass = 'js_ajax-by-click-btn';

    /**
     * Apply
     *
     * @param string $action
     * @param array  $params
     * @param string $method
     *
     * @param bool   $successNotification
     * @param bool   $errorNotification
     *
     * @param bool   $reloadOnSuccess
     *
     * @return JsActionsApplicable
     */
    public function regular(
        string $action,
        array $params = [],
        string $method = 'POST',
        bool $successNotification = true,
        bool $errorNotification = false,
        bool $reloadOnSuccess = false
    ): JsActionsApplicable {
        $this->applyActionClass();
        $this->applyBasicAttributes($action, $method);
        $this->applyAttrs($params);

        $this->element->attr('data-success-msg', $successNotification);
        $this->element->attr('data-error-msg', $errorNotification);
        $this->element->attr('data-reload-after-success', $reloadOnSuccess);

        return $this->element;
    }

    /**
     *  Put the response content to the block
     *
     * @param string $action
     * @param string $resultIdentifier
     * @param array  $params
     * @param string $method
     *
     * @param bool   $successNotification
     * @param bool   $errorNotification
     *
     * @param bool   $reloadOnSuccess
     *
     * @return JsActionsApplicable
     */
    public function showResponse(
        string $action,
        string $resultIdentifier,
        array $params = [],
        string $method = 'POST',
        bool $successNotification = true,
        bool $errorNotification = false,
        bool $reloadOnSuccess = false
    ): JsActionsApplicable {
        $this->element->attr('data-result-blk', $resultIdentifier);

        return $this->regular($action, $params, $method, $successNotification, $errorNotification, $reloadOnSuccess);
    }

    /**
     *  Replace the block with the response content
     *
     * @param string $action
     * @param string $replacingIdentifier
     * @param array  $params
     * @param string $method
     *
     * @param bool   $successNotification
     * @param bool   $errorNotification
     *
     * @param bool   $reloadOnSuccess
     *
     * @return JsActionsApplicable
     */
    public function replaceWithResponse(
        string $action,
        string $replacingIdentifier,
        array $params = [],
        string $method = 'POST',
        bool $successNotification = true,
        bool $errorNotification = false,
        bool $reloadOnSuccess = false
    ): JsActionsApplicable {
        $this->element->attr('data-replace-blk', $replacingIdentifier);

        return $this->regular($action, $params, $method, $successNotification. $errorNotification, $reloadOnSuccess);
    }

    /**
     * Apply basic attributes
     *
     * @param string              $action
     * @param string              $method
     *
     */
    protected function applyBasicAttributes(string $action, string $method)
    {
        $this->element->attrs([
            'data-action' => $action,
            'data-method' => $method
        ]);
    }

    /**
     * Apply action class
     *
     */
    protected function applyActionClass()
    {
        $this->element->addClass($this->actionClass);
    }

    /**
     * Apply params
     *
     * @param array $params
     */
    protected function applyAttrs(array $params)
    {
        $this->element->attrs($params);
    }
}

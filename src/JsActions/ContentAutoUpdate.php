<?php


namespace Webmagic\Dashboard\JsActions;

use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class ContentAutoUpdate extends JsActionApplicator
{
    /**
     * Apply action
     *
     * @param string $resultBlockClass
     * @param string $action
     * @param string $method
     * @param int    $timeout
     *
     * @param bool   $replaceResultElement
     *
     * @return JsActionsApplicable
     */
    public function apply(
        string $resultBlockClass,
        string $action,
        string $method = 'GET',
        int $timeout = 3000,
        bool $replaceResultElement = false
    ) {
        $this->element
            ->addClass('js-update')
            ->attrs([
                'data-url' => $action,
                'data-timeout' => $timeout,
                'data-class' => str_start($resultBlockClass, '.'),
                'data-method' => $method,
                'data-replace' => (int)$replaceResultElement
            ]);

        return $this->element;
    }

    /**
     * Update current element content
     *
     * @param string $action
     * @param string $method
     * @param int    $timeout In milliseconds
     *
     * @return JsActionsApplicable
     */
    public function updateCurrentElContent(string $action, string $method = 'GET', int $timeout = 3000)
    {
        $uniqClass = 'js_content-update-'.uniqid();
        $this->element->addClass($uniqClass);

        return $this->apply($uniqClass, $action, $method, $timeout);
    }

    /**
     *
     *
     * @param string $action
     * @param string $method
     * @param int    $timeout
     *
     * @return JsActionsApplicable
     */
    public function replaceCurrentElWithContent(string $action, string $method = 'GET', int $timeout = 3000)
    {
        $uniqClass = 'js_content-update-'.uniqid();
        $this->element->addClass($uniqClass);

        return $this->apply($uniqClass, $action, $method, $timeout, true);
    }

}

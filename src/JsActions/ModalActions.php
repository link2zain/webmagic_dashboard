<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class ModalActions extends JsActionApplicator
{
    /**
     * Configure element to open modal window
     *
     * @param string $title
     * @param string $size
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function regular(string $title = '', string $size = '', bool $reloadOnClose = false): JsActionsApplicable
    {
        $this->element->attrs([
           'data-modal' => 1,
           'data-modal-ttl' => $title,
           'data-modal-size' => $size,
           'data-reload-after-close-modal' => $reloadOnClose
        ]);

        return $this->element;
    }

    /**
     * Fast apply small modal window
     *
     * @param string $title
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function small(string $title = '', bool $reloadOnClose = false): JsActionsApplicable
    {
        return $this->regular($title, 'modal-sm', $reloadOnClose);
    }

    /**
     * Fast apply big modal window
     *
     * @param string $title
     *
     * @param bool   $reloadOnClose
     *
     * @return JsActionsApplicable
     */
    public function big(string $title = '', bool $reloadOnClose = false): JsActionsApplicable
    {
        return $this->regular($title, 'modal-lg', $reloadOnClose);
    }
}

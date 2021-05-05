<?php


namespace Webmagic\Dashboard\JsActions;


class ConfirmationPopup extends JsActionApplicator
{
    /**
     * Add confirmation popup
     *
     * @param string|null $confirmTitle
     * @param string|null $confirmContent
     * @param string|null $confirmButtonTxt
     * @param string|null $cancelButtonTxt
     */
    public function regular(
        string $confirmTitle = null,
        string $confirmContent = null,
        string $confirmButtonTxt = null,
        string $cancelButtonTxt = null
    ) {
        $this->element->attrs([
           'data-confirm' => 'true',
           'data-confirm-ttl' => $confirmTitle ?? __('dashboard::common.confirmation.title'),
           'data-confirm-cnt' => $confirmContent ?? __('dashboard::common.confirmation.content'),
           'data-confirm-btn-txt' => $confirmButtonTxt ?? __('dashboard::common.confirmation.confirm-btn'),
           'data-confirm-btn-cancel-txt' => $cancelButtonTxt ?? __('dashboard::common.confirmation.cancel-btn')
        ]);

        return $this->element;
    }
}

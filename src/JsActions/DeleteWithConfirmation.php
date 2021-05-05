<?php


namespace Webmagic\Dashboard\JsActions;


use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

class DeleteWithConfirmation extends JsActionApplicator
{
    /**
     * Apply action for send request with confirmation and deleting the block on success
     *
     * @param string      $action
     * @param string|null $removingBlockId
     * @param string      $method
     *
     * @param string|null $modalTitle
     * @param string|null $modalContent
     *
     * @return JsActionsApplicable
     */
    public function regular(
        string $action,
        string $removingBlockId = null,
        string $method = 'POST',
        string $modalTitle = null,
        string $modalContent = null
    ): JsActionsApplicable {
        $this->element->attrs([
            'data-request' => $action,
            'data-method' => $method
        ])
            ->addClass('js_delete');

        if ($removingBlockId !== null) {
            $this->element->attr('data-item', $removingBlockId);
        }

        if($modalTitle !== null){
            $this->element->attr('data-delete-modal-ttl', $modalTitle);
        }

        if($modalContent !== null){
            $this->element->attr('data-delete-modal-cnt', $modalContent);
        }

        return $this->element;
    }
}

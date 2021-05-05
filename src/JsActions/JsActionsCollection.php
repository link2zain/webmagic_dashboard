<?php


namespace Webmagic\Dashboard\JsActions;

use Webmagic\Dashboard\Core\Content\JsActionsApplicable;

/**
 *
 * @package Webmagic\Dashboard\JsActions
 *
 * @method OpenInModalOnClick openInModalOnClick()
 * @method OpenInModalOnClick openInModalOnChange()
 * @method SendRequestOnClick sendRequestOnClick()
 * @method SendRequestOnChange sendRequestOnChange()
 * @method DeleteWithConfirmation deleteWithConfirmation()
 * @method ActivityController activityController()
 * @method Tooltip tooltip()
 * @method ContentAutoUpdate contentAutoUpdate()
 * @method ConfirmationPopup confirmationPopup()
 * @method ContentCopy contentCopy()
 */

class JsActionsCollection
{
    /** @var array Registered actions */
    protected $jsActions = [
        'openInModalOnClick' => OpenInModalOnClick::class,
        'openInModalOnChange' => OpenInModalOnChange::class,
        'sendRequestOnClick' => SendRequestOnClick::class,
        'sendRequestOnChange' => SendRequestOnChange::class,
        'deleteWithConfirmation' => DeleteWithConfirmation::class,
        'activityController' => ActivityController::class,
        'tooltip' => Tooltip::class,
        'contentAutoUpdate' => ContentAutoUpdate::class,
        'confirmationPopup' => ConfirmationPopup::class,
        'contentCopy' => ContentCopy::class,
    ];

    /** @var JsActionsApplicable */
    protected $element;

    /**
     * JsActionsApplicator constructor.
     *
     * @param JsActionsApplicable $element
     */
    public function __construct(JsActionsApplicable $element)
    {
        $this->element = $element;
    }

    /**
     * Start action applying
     *
     * @param $name
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $params)
    {
        if (!key_exists($name, $this->jsActions)) {
            throw new \Exception("The action with name $name not registered");
        }

        return new $this->jsActions[$name]($this->element);
    }
}

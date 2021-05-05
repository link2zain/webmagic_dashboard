<?php


namespace Webmagic\Dashboard\Core;

use Webmagic\Dashboard\Core\Content\AttributesAvailable;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\JsActionsApplicable;
use Webmagic\Dashboard\Core\Content\JsActionsApplicableTrait;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;
use Webmagic\Dashboard\Elements\Factories\CreateElementsTrait;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\View\ViewUsable;

class ComplexElement extends AbstractComplexRenderableElement implements
    ContentFieldsUsable,
    CreatesElements,
    AttributesAvailable,
    JsActionsApplicable
{
    use ViewUsable, ContentFieldsUsableTrait, CreateElementsTrait, JsActionsApplicableTrait;

    /**
     * Return all the data which need for render the view
     *
     * @return array
     * @throws Content\Exceptions\NoOneFieldsWereDefined
     */
    public function getViewData(): array
    {
        return $this->toArray();
    }
}

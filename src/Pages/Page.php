<?php

namespace Webmagic\Dashboard\Pages;

use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\Content\JsActionsApplicable;
use Webmagic\Dashboard\Core\Content\JsActionsApplicableTrait;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;
use Webmagic\Dashboard\Elements\Factories\CreateElementsTrait;
use Webmagic\Dashboard\Core\View\ViewUsable;

class Page extends AbstractPage implements ContentFieldsUsable, CreatesElements, JsActionsApplicable
{
    use ViewUsable, ContentFieldsUsableTrait, CreateElementsTrait, JsActionsApplicableTrait;

    /**
     * Return all the data which need for render the view
     *
     * @return array
     * @throws NoOneFieldsWereDefined
     */
    public function getViewData(): array
    {
        return $this->toArray();
    }
}

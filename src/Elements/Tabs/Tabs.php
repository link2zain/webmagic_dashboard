<?php


namespace Webmagic\Dashboard\Elements\Tabs;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Tabs\Tabs tabs(Webmagic\Dashboard\Elements\Tabs\Tab $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tabs addTabs(Webmagic\Dashboard\Elements\Tabs\Tab $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tabs navigation(Webmagic\Dashboard\Elements\Tabs\Navigation $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tabs addNavigation(Webmagic\Dashboard\Elements\Tabs\Navigation $valueOrConfig)
 *
 ********************************************************************************************************************/

class Tabs extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.tabs.tabs';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'tabs' => [
            'type' => Tab::class,
            'array_acceptable' => true
        ],
        'navigation' => [
            'type' => Navigation::class
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'tabs';

    /**
     * Prepare navigation if not set
     *
     * @return CreatesElements|Navigation|ContentFieldsUsableTrait
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     * @throws NoOneFieldsWereDefined
     */
    public function getNavigation()
    {
        if (isset($this->navigation) || !isset($this->tabs)) {
            return $this->navigation;
        }

        return (new Navigation())->navigationTabs($this->tabs);
    }

    /**
     * Add new tab and return it
     *
     * @return Tab
     */
    public function addTab()
    {
        return $this->addElement()->tab();
    }
}

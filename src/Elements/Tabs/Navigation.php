<?php


namespace Webmagic\Dashboard\Elements\Tabs;

use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Tabs\Navigation class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Navigation addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Navigation navigationTabs(Webmagic\Dashboard\Elements\Tabs\Tab $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Navigation addNavigationTabs(Webmagic\Dashboard\Elements\Tabs\Tab $valueOrConfig)
 *
 ********************************************************************************************************************/

class Navigation extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.tabs.navigation';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'class',
        'navigation_tabs' => [
            'type' => Tab::class,
            'array_acceptable' => true
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'classes';
}

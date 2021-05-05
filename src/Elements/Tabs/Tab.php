<?php


namespace Webmagic\Dashboard\Elements\Tabs;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab addContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab active(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab addActive(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab addTitle($valueOrConfig)
 *
 ********************************************************************************************************************/

class Tab extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.tabs.tab';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'content',
        'id',
        'class',
        'active' => [
            'type' => 'bool',
            'default' => false
        ],
        'title'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'content';

    /**
     * Tab constructor.
     *
     * @param null $content
     *
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->id = 'id_'.uniqid();

        parent::__construct($content);
    }

    /**
     * Set tab active
     *
     * @param bool $status
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function active(bool $status = true)
    {
        $this->param('active', $status);

        return $this;
    }
}

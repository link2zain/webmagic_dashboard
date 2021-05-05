<?php


namespace Webmagic\Dashboard\Elements\Boxes;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxTools($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxTools($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxBody($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxBody($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxFooter($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxFooter($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxBodyClasses($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxBodyClasses($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box boxHeaderContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addBoxHeaderContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box headerAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addHeaderAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box footerAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addFooterAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box colorType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addColorType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box solid(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box addSolid(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class Box extends ComplexElement
{
    protected $view = 'dashboard::elements.boxes.box';

    protected $available_fields = [
        'box_type',
        'box_title',
        'box_tools',
        'box_body',
        'box_footer',
        'class',
        'box_body_classes',
        'box_header_content',
        'header_available' => [
            'type' => 'bool',
            'default' => true
        ],
        'footer_available' => [
            'type' => 'bool',
            'default' => true
        ],
        'color_type' => [
            'default' => 'default',
            'acceptable_values' => [
                'default',
                'primary',
                'info',
                'warning',
                'success',
                'danger'
            ]
        ],
        'solid' => [
            'type' => 'bool',
            'default' => false
        ]
    ];

    protected $default_field = 'box_body';

    /**
     * @param string $link
     * @param string $label
     * @param string $iconClass
     * @param string $buttonClass
     *
     * @throws NoOneFieldsWereDefined
     */
    public function setToolsLinkButton(
        string $link,
        string $label = '',
        string $iconClass = '',
        string $buttonClass = 'btn-default'
    ) {
        $this->headerAvailable(true);

        $this->element('box_tools')
            ->linkButton()
            ->content($label)
            ->link($link)
            ->class($buttonClass)
            ->icon($iconClass);

        // add space for beauty view
        $this->addBoxTools(' ');
    }

    /**
     * Add link button to tools area
     *
     * @param string $link
     * @param string $label
     * @param string $iconClass
     * @param string $buttonClass
     *
     * @return $this
     * @throws NoOneFieldsWereDefined
     */
    public function addToolsLinkButton(
        string $link,
        string $label = '',
        string $iconClass = '',
        string $buttonClass = 'btn-default'
    ) {

        $this->headerAvailable(true);

        $this->addElement('box_tools')
            ->linkButton()
            ->content($label)
            ->link($link)
            ->class($buttonClass)
            ->icon($iconClass);

        // add space for beauty view
        $this->addBoxTools(' ');

        return $this;
    }

    /**
     * Simplify the box view
     */
    public function makeSimple()
    {
        return $this
            ->headerAvailable(false)
            ->footerAvailable(false);
    }
}

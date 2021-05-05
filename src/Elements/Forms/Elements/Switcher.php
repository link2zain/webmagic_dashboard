<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher labelClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addLabelClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher width($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addWidth($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher height($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addHeight($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher background($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addBackground($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher checked(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addChecked(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher addRequired(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class Switcher extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.forms.elements.switcher';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'class',
        'label_class',
        'name',
        'value' => [
            'default' => 'true'
        ],
        'width' => [
            'default' => '35'
        ],
        'height' => [
            'default' => '20'
        ],
        'background' => [
            'acceptable_values' => [
                '',
                'bg-aqua',
                'bg-yellow',
                'bg-red'
            ]
        ],
        'checked' => [
            'type' => 'bool',
            'default' => false
        ],
        'required' => [
            'type' => 'bool',
            'default' => false
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'checked';

    /**
     * Switcher constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->id = 'switcher_'.uniqid();

        parent::__construct($content);
    }

    /**
     * @param $value
     *
     * @return mixed
     * @deprecated
     */
    public function classes($value)
    {
        return $this->class($value);
    }

    /**
     * @param $value
     *
     * @return Switcher
     * @throws NoOneFieldsWereDefined
     *
     * @deprecated
     */
    public function addClasses($value)
    {
        return $this->addClass($value);
    }

    /**
     * @param $value
     *
     * @return mixed
     *
     * @deprecated
     */
    public function labelClasses($value)
    {
        return $this->labelClass($value);
    }

    /**
     * @param $value
     *
     * @return mixed
     *
     * @deprecated
     */
    public function addLabelClasses($value)
    {
        return $this->addLabelClass($value);
    }


    /**
     * Set background to aqua
     */
    public function makeAqua()
    {
        $this->background = 'bg-aqua';
    }

    /**
     * Set background to yellow
     */
    public function makeYellow()
    {
        $this->background = 'bg-yellow';
    }

    /**
     * Set background to red
     */
    public function makeRed()
    {
        $this->background = 'bg-red';
    }
}

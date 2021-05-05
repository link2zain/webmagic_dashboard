<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown classes($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addClasses($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown multiple(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addMultiple(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown options(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addOptions(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown selectedKey($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addSelectedKey($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown addRequired(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class DateDropdown extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.forms.elements.date_dropdown';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'name',
        'classes',
        'multiple' => [
            'type' => 'bool',
            'default' => false
        ],
        'placeholder' => [
            'default' => ''
        ],
        'options' => [
            'type' => 'array'
        ],
        'selected_key',
        'required' => [
            'type' => 'bool',
            'default' => false
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = '';

    /**
     * Input constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->id = uniqid();

        parent::__construct($content);
    }

    /**
     * Name field validation
     *
     * @param $value
     * @return bool
     */
    public function isValidNameFieldValue($value)
    {
        return strlen($value) > 0;
    }
}

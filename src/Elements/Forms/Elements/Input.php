<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class Input extends ComplexElement
{
    protected $view = 'dashboard::elements.forms.elements.input';

    protected $available_fields = [
        'id',
        'class' => [
            'default' => 'form-control'
        ],
        'type' => [
            'acceptable_values' => [
                'text',
                'tel',
                'email',
                'phone',
                'password',
                'button',
                'submit',
                'file',
                'date',
                'time',
                'datetime-local'
            ],
            'default' => 'text'
        ],
        'required' => [
            'type' => 'bool',
            'default' => false
        ],
        'value',
        'placeholder',
        'name'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'value';

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

<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use function PHPSTORM_META\type;
use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 **********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input id( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input class( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input type( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input required( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input value( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input placeholder( $value )
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input name( $value )
 *
 ********************************************************************************************************************/


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox checked(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addChecked(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox text($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox addText($valueOrConfig)
 *
 ********************************************************************************************************************/

class Checkbox extends ComplexElement
{
    protected $view = 'dashboard::components.form.elements.checkbox';

    protected $available_fields = [
        'id',
        'class',
        'checked' => [
            'type' => 'bool',
            'default' => false
        ],
        'required' => [
            'type' => 'bool',
            'default' => false
        ],
        'value' => [
            'default' => 'true'
        ],
        'name',
        'text'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'text';

    /**
     * Input constructor.
     *
     * @param null $content
     *
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        $this->id = uniqid();
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

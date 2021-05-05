<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea cols($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addCols($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea rows($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addRows($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea addContent($valueOrConfig)
 *
 ********************************************************************************************************************/

class Textarea extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.forms.elements.textarea';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'class' => [
            'default' => 'form-control'
        ],
        'name',
        'cols' => [
            'default' => '50'
        ],
        'rows' => [
            'default' => '10'
        ],
        'title',
        'placeholder',
        'required'=> [
            'type' => 'bool',
            'default' => false,
        ],
        'content'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'content';

    /**
     * Input constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
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

<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class Color extends Input
{
    /** @var  string Component view name */
    protected $view = 'dashboard::components.form.elements.color';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'class'    => [
            'default' => 'js-color-pick',
        ],
        'type'     => [
            'default' => 'text',
        ],
        'required' => [
            'type'    => 'bool',
            'default' => false,
        ],
        'value'    => [
            'default' => 'ffffff',
        ],
        'placeholder',
        'name'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'value';
}

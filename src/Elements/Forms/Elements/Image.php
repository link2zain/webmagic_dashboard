<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Image name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Image addName($valueOrConfig)
 *
 ********************************************************************************************************************/
// TODO Check the functionality
class Image extends \Webmagic\Dashboard\Core\ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::components._image_load';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'name'
        //         'name' => [
        //              'type' => ''                //string, bool, renderable, array
        //              'default' => $value,        //default value
        //              'acceptable_values' => []   //array of available values
        //              'array_acceptable' => false // additional show if array field acceptable
        //         ]
        //     ];
    ];

    /** @var  string Default section for current component */
    protected $default_field = '';
}

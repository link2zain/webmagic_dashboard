<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor cols($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addCols($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor rows($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addRows($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor content($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor addContent($valueOrConfig)
 *
 ********************************************************************************************************************/

class VisualEditor extends Textarea
{
    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'class' => [
            'default' => 'form-control js_summernote'
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

    /**
     * Turn on functionality for upload files
     *
     * Images will be saved as Base64 if this url was not added
     *
     * @param string $uploadUrl
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function turnOnFileUpload(string $uploadUrl): VisualEditor
    {
        $this->attr('data-upload-url', $uploadUrl);

        return $this;
    }
}

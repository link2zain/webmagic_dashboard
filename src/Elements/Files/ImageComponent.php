<?php


namespace Webmagic\Dashboard\Elements\Files;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent imgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addImgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent fileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addFileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent downloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addDownloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent size($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addSize($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent width($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addWidth($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent height($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addHeight($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent action($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addAction($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent method($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent deleteAction($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addDeleteAction($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent deleteMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addDeleteMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent noCaching(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent addNoCaching(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class ImageComponent extends ImagePreview
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.files.image_component';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'img_url' => [
            'type' => 'string'
        ],
        'file_name',
        'download_url',
        'size',
        'width',
        'height',
        'title',
        'name',
        'action',
        'method' => [
            'default' => 'POST'
        ],
        'id',
        'delete_action',
        'delete_method' => [
            'default' => 'POST'
        ],
        'no_caching' => [
            'type' => 'bool',
            'default' => true
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'img_url';

    /**
     * Clean up default image
     */
    protected function setDefaultImage()
    {
        $this->available_fields['img_url']['default'] = '';
    }

    /**
     * ImageComponent constructor.
     *
     * @param null $content
     *
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        $this->param('id', uniqid());
    }


}

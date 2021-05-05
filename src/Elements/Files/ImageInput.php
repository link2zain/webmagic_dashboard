<?php


namespace Webmagic\Dashboard\Elements\Files;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput imgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addImgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput fileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addFileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput downloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addDownloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput size($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addSize($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput width($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addWidth($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput height($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addHeight($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class ImageInput extends ImagePreview
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.files.image_input';

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
        'name'
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
}

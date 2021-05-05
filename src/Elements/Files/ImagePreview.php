<?php

namespace Webmagic\Dashboard\Elements\Files;


use Illuminate\Http\File;
use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview imgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview addImgUrl(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview fileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview addFileName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview downloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview addDownloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview size($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview addSize($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview noCaching(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview addNoCaching(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class ImagePreview extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.files.image_preview';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'img_url' => [
            'type' => 'string'
        ],
        'file_name',
        'download_url',
        'size',
        'no_caching' => [
            'type' => 'bool',
            'default' => true
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'img_url';

    /**
     * ImagePreview constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        $this->setDefaultImage();
    }

    /**
     * Set default image
     */
    protected function setDefaultImage()
    {
        $this->available_fields['img_url']['default'] = config('webmagic.dashboard.dashboard.default_image');
    }


    /**
     * Return download URL
     *
     * @return string|ContentFieldsUsableTrait|CreatesElements
     * @throws NoOneFieldsWereDefined
     */
    public function getDownloadUrl()
    {
        if (isset($this->download_url)) {
            return $this->download_url;
        }

        if ($this->isDefaultImg()) {
            return '';
        }

        return $this->getFieldValue('img_url');
    }

    /**
     * Return file name
     *
     * @return string|ContentFieldsUsableTrait|CreatesElements
     * @throws NoOneFieldsWereDefined
     */
    public function getFileName()
    {
        if ($this->isDefaultImg()) {
            return '';
        }

        if (isset($this->file_name)) {
            return $this->file_name;
        }

        return preg_replace('/\?.*/', '', basename($this->getFieldValue('img_url')));
    }

    /**
     * Initiate with file
     *
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file_name = $file->getFilename().$file->getExtension();

        $this->size = $file->getSize();
    }

    /**
     * Check the default image in use
     *
     * @return bool
     * @throws NoOneFieldsWereDefined
     */
    protected function isDefaultImg()
    {
        return empty($this->img_url) || $this->img_url === $this->getFieldDefaultValue('img_url');
    }
}

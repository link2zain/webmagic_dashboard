<?php

namespace Webmagic\Dashboard\Elements\Files;


use Illuminate\Http\File;
use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Elements\StringElement;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview icon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview addIcon($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview downloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview addDownloadUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview size($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview addSize($valueOrConfig)
 *
 ********************************************************************************************************************/

class FilePreview extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::elements.files.file_preview';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'icon' => [
            'default' => 'fas fa-file-o'
        ],
        'name',
        'download_url',
        'size'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'download_url';


    /**
     * @return string|\Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait|\Webmagic\Dashboard\Elements\Factories\CreatesElements
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function getFileName()
    {
        if(isset($this->file_name)){
            return $this->file_name;
        }

        return basename($this->getFieldValue('download_url'));
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
}

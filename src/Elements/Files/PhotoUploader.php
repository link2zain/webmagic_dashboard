<?php


namespace Webmagic\Dashboard\Elements\Files;


use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\ElementsCreateAbleContract;
use Webmagic\Dashboard\Elements\Factories\ElementsFactory;
use Webmagic\Dashboard\Elements\Forms\Elements\Input;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class PhotoUploader extends Input
{
    protected $view = 'dashboard::elements.forms.elements.photos_upload_input';

    /**
     * PhotoUploader constructor.
     */
    public function __construct()
    {
        $this->class('js_filepond');
    }

    /**
     * @param string $name
     *
     * @return PhotoUploader
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function setName(string $name)
    {
        $this->name = $name;

        $name = str_replace('[]', '', $name);

        $filesNamesFieldName = "{$name}_files_names";
        $this->attr('data-files-names-input', $filesNamesFieldName);
        $this->attr('data_files_names_input', $filesNamesFieldName);

        return $this;
    }


    /**
     * Set URL for request
     *
     * @param string $requestUrl
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function requestUrl(string $requestUrl)
    {
        return $this->attr('data-url', $requestUrl);
    }

    /**
     * Set URL for delete request
     *
     * @param string $deleteUrl
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function deleteUrl(string $deleteUrl)
    {
        return $this->attr('data-url-delete', $deleteUrl);
    }

    /**
     * Set all images
     *
     * @param string ...$images
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function images(string ... $images)
    {
        // Escape double quotes for correct work
        $preparedJson = htmlspecialchars(json_encode($images, JSON_UNESCAPED_SLASHES ));
        return $this->attr('data-files', $preparedJson);
    }
}

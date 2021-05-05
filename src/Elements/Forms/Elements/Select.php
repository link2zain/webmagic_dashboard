<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select multiple(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addMultiple(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select options(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addOptions(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select selectedKey($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addSelectedKey($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select selectedKeys(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select addRequired(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class Select extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.forms.elements.select';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'name',
        'class' => [
            'default' => 'form-control'
        ],
        'multiple' => [
            'type' => 'bool',
            'default' => false
        ],
        'placeholder' => [
            'default' => ''
        ],
        'options' => [
            'type' => 'array'
        ],
        'selected_key',
        'selected_keys' => [
            'type' => 'array'
        ],
        'required' => [
            'type' => 'bool',
            'default' => false
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = '';

    /**
     * Input constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->id = uniqid();

        parent::__construct($content);
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

    /**
     * @param array $value
     *
     * @return Select
     */
    public function addSelectedKeys(array $value = null)
    {
        if (is_array($value)) {
            if (isset($this->selected_keys)) {
                $value = array_merge($value, $this->selected_keys);
            }

            $this->selected_keys = $value;
        }

        return $this;
    }

    /**
     * Add selected key functionality
     *
     * @param $value
     *
     * @return Select
     */
    public function addSelectedKey($value)
    {
        return $this->selectedKey($value);
    }

    /**
     * Set selected key
     *
     * @param $value
     */
    protected function setSelectedKey($value)
    {
        if(isset($this->selected_keys) && isset($this->selected_key) && in_array($this->selected_key, $this->selected_keys)) {
            $index = array_search($value, $this->selected_keys);

            unset($this->selected_keys[$index]);
        }

        $this->selected_key = $value;
        $this->addSelectedKeys([$value]);

        dump($this);
    }
}

<?php


namespace Webmagic\Dashboard\Components;

use ArrayAccess;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Buttons\DefaultButton;
use Webmagic\Dashboard\Elements\Factories\ElementsFactory;
use Webmagic\Dashboard\Elements\Forms\Elements\ClearButton;
use Webmagic\Dashboard\Elements\Forms\Elements\FormGroup;
use Webmagic\Dashboard\Elements\Forms\Elements\NumberInput;
use Webmagic\Dashboard\Elements\Forms\Form;

class FormGenerator implements Renderable
{
    /** @var Form */
    protected $form;

    /** @var FormGroup */
    protected $submitButtonsGroup;

    /**
     * FormGenerator constructor.
     *
     * @param Form|null $form
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct(Form $form = null)
    {
        if (is_null($form)) {
            $form = $this->initNewForm();
        }

        $this->form = $form;
    }

    /**
     * Init new form and set it
     *
     * @throws NoOneFieldsWereDefined
     *
     * @return Form
     */
    protected function initNewForm()
    {
        return (new Form())->ajax();
    }

    /**
     * Set form ajax
     *
     * @param bool   $status
     * @param string $resultBlockClass
     * @param string $resultReplaceBlkClass
     * @param bool   $successNotification
     * @param bool   $errorNotification
     *
     * @return $this
     * @throws NoOneFieldsWereDefined
     */
    public function ajax(
        bool $status = true,
        string $resultBlockClass = '',
        string $resultReplaceBlkClass = '',
        bool $successNotification = true,
        bool $errorNotification = true
    ) {
        $this->getForm()->ajax(
            $status,
            $resultBlockClass,
            $resultReplaceBlkClass,
            $successNotification,
            $errorNotification
        );

        return $this;
    }

    /**
     * Return form
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set method
     *
     * @param $method
     * @return $this
     */
    public function method($method)
    {
        $this->getForm()->method($method);

        return $this;
    }

    /**
     * Set block for ajax form result
     *
     * @param string $elementClass
     * @return FormGenerator
     */
    public function resultBlockClass(string $elementClass)
    {
        $this->getForm()->resultBlockClass($elementClass);

        return $this;
    }

    /**
     * Set block for ajax form result
     *
     * @param string $elementClass
     * @return FormGenerator
     */
    public function replaceBlockClass(string $elementClass)
    {
        $this->getForm()->resultReplaceBlockClass($elementClass);

        return $this;
    }

    /**
     * Set form action
     *
     * @param $action
     * @return $this
     */
    public function action($action)
    {
        $this->getForm()->action($action);

        return $this;
    }

    /**
     * Add submit button
     *
     * @param string $title
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function submitButton(string $title = null)
    {
        $title = $title ?? trans('dashboard::common.forms.submit');

        $this->addSubmitButton([], $title, ' btn btn-primary float-right ml-2');

        return $this;
    }

    /**
     * Add additional configurable submit button
     *
     * @param array  $attributes
     * @param string $title
     * @param string $class
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function addSubmitButton(
        array $attributes = [],
        string $title = '',
        string $class = ' btn btn-default float-right ml-2'
    ) {
        $btn = (new DefaultButton($title))->type('submit')->class($class);

        foreach ($attributes as $name => $val) {
            $btn->attr($name, $val);
        }

        $this->getSubmitButtonGroup()->addContent($btn);

        return $this;
    }

    /**
     * @param string $title
     *
     * @return FormGenerator
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function clearButton(string $title = null)
    {
        $title = $title ?? trans('dashboard::common.forms.clear');

        return $this->addClearButton([], $title);
    }

    /**
     * Add clear button
     *
     * @param array  $attributes
     * @param string $title
     * @param string $class
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function addClearButton(
        array $attributes = [],
        string $title = '',
        string $class = ' btn  btn-danger float-right ml-2'
    ) {
        $btn = (new ClearButton())->value($title)->class($class);

        foreach ($attributes as $name => $val) {
            $btn->attr($name, $val);
        }

        $this->getSubmitButtonGroup()->addContent($btn);

        return $this;
    }

    /**
     * Add link button
     *
     * @param string $link
     * @param string $title
     * @param string $class
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function addLinkButton(
        string $link,
        string $title = '',
        string $class = ' btn btn-default ml-2',
        array $attributes = []
    ) {
        $this->getSubmitButtonGroup()->addElement()
            ->linkButton($title)
            ->class($class)
            ->link($link)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Generate submit button group
     *
     * @return FormGroup
     * @throws NoOneFieldsWereDefined
     */
    protected function getSubmitButtonGroup() : FormGroup
    {
        if (empty($this->submitButtonsGroup)) {
            $this->submitButtonsGroup = $this->prepareNextFormGroup();
        }

        return $this->submitButtonsGroup;
    }

    /**
     * Add select
     *
     * @param string $name
     * @param array  $options
     * @param string $selectedKeys
     * @param string $labelTxt
     * @param bool   $required
     * @param bool   $multiple
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function select(
        string $name,
        array $options,
        $selectedKeys = '',
        string $labelTxt = '',
        bool $required = false,
        bool $multiple = false,
        array $attributes = []
    ) {
        $selectedKeys = $this->getData($selectedKeys, $name);
        $selectedKeys = array_wrap($selectedKeys);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->select()
            ->name($name)
            ->options($options)
            ->id($identifier)
            ->required($required)
            ->multiple($multiple)
            ->selectedKeys($selectedKeys)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add select implemented with js
     *
     * @param string $name
     * @param array  $options
     * @param string $selectedKeys
     * @param string $labelTxt
     * @param bool   $required
     * @param bool   $multiple
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function selectJS(
        string $name,
        array $options,
        $selectedKeys = '',
        string $labelTxt = '',
        bool $required = false,
        bool $multiple = false,
        array $attributes = []
    ) {
        $selectedKeys = $this->getData($selectedKeys, $name);
        $selectedKeys = array_wrap($selectedKeys);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->selectJS()
            ->name($name)
            ->options($options)
            ->id($identifier)
            ->required($required)
            ->multiple($multiple)
            ->selectedKeys($selectedKeys)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add select implemented with js with autocomplete
     *
     * @param string $name
     * @param string $requestUrl
     * @param string $selectedKeys
     * @param string $labelTxt
     * @param bool   $required
     * @param bool   $multiple
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function selectWithAutocomplete(
        string $name,
        string $requestUrl,
        array $options = [],
        $selectedKeys = '',
        string $labelTxt = '',
        bool $required = false,
        bool $multiple = false,
        array $attributes = []
    ) {
        $selectedKeys = $this->getData($selectedKeys, $name);
        $selectedKeys = array_wrap($selectedKeys);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->selectJS()
            ->addAutocomplete($requestUrl)
            ->name($name)
            ->options($options)
            ->id($identifier)
            ->required($required)
            ->multiple($multiple)
            ->selectedKeys($selectedKeys)
            ->attrs($attributes);

        return $this;
    }


    /**
     * Add text input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function textInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }


    /**
     * Add text input
     *
     * @param string $name
     * @param string $sourceName
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param string $separator
     * @param string $transformRule - possible options: 'lowercase', 'uppercase', 'false'
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function slugInput(
        string $name,
        string $sourceName,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        string $separator = '-',
        string $transformRule = 'lowercase',
        array $attributes = []
    ) {
        // Add simple text input if slug was set before
        if (!is_null($valueOrDataSource)) {
            return $this->textInput($name, $valueOrDataSource, $labelTxt, $required, $attributes);
        }

        $identifier = uniqid();
        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->addClass('js_get-slug')
            ->attr('data-source-name', $sourceName)
            ->attr('data-separator', $separator)
            ->attr('data-transformer', $transformRule)

            ->name($name)
            ->required($required)
            ->id($identifier)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add email input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function emailInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->type('email')
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add password input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function passwordInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->type('password')
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add text input
     *
     * @param string     $name
     * @param null       $valueOrDataSource
     * @param string     $labelTxt
     * @param bool       $required
     * @param float      $step
     * @param float|null $min
     * @param float|null $max
     *
     * @param array      $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function numberInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        float $step = 1,
        float $min = null,
        float $max = null,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $input = (new NumberInput([
            'name' => $name,
            'required' => $required,
            'id' => $identifier,
            'value' => $value
        ]))->attrs($attributes);

        $input->step($step);

        if (!is_null($min)) {
            $input->min($min);
        }

        if (!is_null($max)) {
            $input->max($max);
        }

        $this->prepareNextFormGroup($labelTxt, $identifier)->content($input);

        return $this;
    }

    /**
     * Add custom input
     *
     * @param string $name
     * @param null $valueOrDataSource
     * @param string $labelTxt
     * @param string $type
     * @param bool $required
     * @param string|null $placeholder
     * @param array|null $attributes
     * @param string $class
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function input(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        string $type = 'text',
        bool $required = false,
        string $placeholder = null,
        array $attributes = [],
        string $class = ' form-control '
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->name($name)
            ->value($value)
            ->type($type)
            ->required($required)
            ->id($identifier)
            ->placeholder($placeholder)
            ->class($class)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add hidden input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     *
     * @return $this
     * @throws NoOneFieldsWereDefined
     */
    public function hiddenInput(
        string $name,
        $valueOrDataSource = null
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->getContentPart()->addElement()->input()
            ->name($name)
            ->id($identifier)
            ->value($value)
            ->type('hidden');

        return $this;
    }

    /**
     * Return content part for adding elements
     *
     * @return Form|null
     */
    protected function getContentPart()
    {
        return $this->form;
    }

    /**
     * Add date input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dateInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateInput()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add date picker JS
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function datePickerJS(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateTimePicker()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Date range picker
     *
     * @param string $name
     * @param string $endName
     * @param null   $valueOrDataSource
     * @param null   $endValueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param bool   $endRequired
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dateRangePicker(
        string $name,
        string $endName,
        $valueOrDataSource = null,
        $endValueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        bool $endRequired = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $endValue = $this->getData($endValueOrDataSource, $endName);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateTimePicker()
            ->name($name)
            ->nameEnd($endName)
            ->required($required)
            ->requiredEnd($endRequired)
            ->id($identifier)
            ->value($value)
            ->range(true)
            ->valueEnd($endValue)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add time input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function timeInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->timeInput()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add time input
     *
     * @param string $name
     * @param null $valueOrDataSource
     * @param string $labelTxt
     * @param bool $required
     * @param array $attributes
     * @param bool $time24Format
     * @param bool $showSeconds
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function timePickerJS(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = [],
        bool $time24Format = true,
        bool $showSeconds = true
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateTimePicker()
            ->name($name)
            ->required($required)
            ->time(true)
            ->date(false)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes)
            ->time24format($time24Format)
            ->seconds($showSeconds);

        return $this;
    }

    /**
     * Date and time range picker
     *
     * @param string $name
     * @param string $endName
     * @param null   $valueOrDataSource
     * @param null   $endValueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param bool   $endRequired
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dateTimeRangePicker(
        string $name,
        string $endName,
        $valueOrDataSource = null,
        $endValueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        bool $endRequired = false,
        array $attributes = [],
        bool $time24Format = true,
        bool $showSeconds = true
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $endValue = $this->getData($endValueOrDataSource, $endName);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()
            ->dateTimePicker()->name($name)->nameEnd($endName)
            ->required($required)
            ->requiredEnd($endRequired)
            ->id($identifier)
            ->value($value)
            ->time(true)
            ->range(true)
            ->valueEnd($endValue)
            ->attrs($attributes)
            ->time24format($time24Format)
            ->seconds($showSeconds);

        return $this;
    }


    /**
     * Add time input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dateTimeInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateTimeInput()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Prepare date time picker
     *
     * @param string $name
     * @param null $valueOrDataSource
     * @param string $labelTxt
     * @param bool $required
     * @param array $attributes
     * @param bool $time24Format
     * @param bool $showSeconds
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dateTimePickerJS(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = [],
        bool $time24Format = true,
        bool $showSeconds = true
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->dateTimePicker()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->time(true)
            ->value($value)
            ->attrs($attributes)
            ->time24format($time24Format)
            ->seconds($showSeconds);

        return $this;
    }

    /**
     * Add file input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function fileInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->input()
            ->name($name)
            ->type('file')
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Image upload and remove area
     *
     * @param string      $name
     * @param string      $requestUrl
     * @param array       $images
     * @param string      $labelTxt
     * @param bool        $required
     * @param bool        $multiple
     * @param string|null $deleteUrl
     * @param array       $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function imageArea(
        string $name,
        array $images = [],
        string $labelTxt = '',
        bool $required = false,
        bool $multiple = true,
        string $requestUrl = null,
        string $deleteUrl = null,
        array $attributes = []
    ) {
        $identifier = uniqid();
        if($multiple) {
            $attributes['multiple'] = 'multiple';
        }

        $requestUrl = $requestUrl ?? route('dashboard.api.image.upload', $name);
        $deleteUrl = $deleteUrl ?? route('dashboard.api.image.delete');

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->photoUploader()
            ->name($name)
            ->type('file')
            ->required($required)
            ->id($identifier)
            ->requestUrl($requestUrl)
            ->deleteUrl($deleteUrl)
            ->images(... $images)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add color picker input
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function colorInput(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->color()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->value($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add textarea
     *
     * @param string $name
     * @param null   $valueOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function textarea(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->textarea()
            ->name($name)
            ->required($required)
            ->id($identifier)
            ->content($value)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add visual editor
     *
     * @param string      $name
     * @param null        $valueOrDataSource
     * @param string      $labelTxt
     * @param bool        $required
     * @param array       $attributes
     *
     * @param string|null $imageUploadUrl
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function visualEditor(
        string $name,
        $valueOrDataSource = null,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = [],
        string $imageUploadUrl = null
    ) {
        $value = $this->getData($valueOrDataSource, $name);
        
        $editor = $this->prepareNextFormGroup($labelTxt)->element()->visualEditor();
        $editor->name($name)
            ->required($required)
            ->content($value)
            ->attrs($attributes);

        // Turn on upload URL if needed
        if($imageUploadUrl){
            $editor->turnOnFileUpload($imageUploadUrl);
        }

        return $this;
    }

    /**
     * Add checkbox
     *
     * @param string $name
     * @param bool   $checkedOrDataSource
     * @param string $labelTxt
     * @param bool   $required `
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function checkbox(
        string $name,
        $checkedOrDataSource = false,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $checked = data_get($checkedOrDataSource, $name, false);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->checkbox()
            ->name($name)
            ->id($identifier)
            ->required($required)
            ->checked((bool) $checked)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add switcher
     *
     * @param string $name
     * @param bool   $checkedOrDataSource
     * @param string $labelTxt
     * @param bool   $required
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function switcher(
        string $name,
        $checkedOrDataSource = false,
        string $labelTxt = '',
        bool $required = false,
        array $attributes = []
    ) {
        $checked = data_get($checkedOrDataSource, $name, false);
        $identifier = uniqid();

        $this->prepareNextFormGroup($labelTxt, $identifier)->element()->switcher()
            ->name($name)
            ->id($identifier)
            ->required($required)
            ->checked((bool) $checked)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Add image input
     *
     * @param string      $name
     * @param             $imageUrlOrDataSource
     * @param string      $title
     * @param string      $size
     * @param string      $width
     * @param string      $height
     * @param string|null $downloadUrl
     * @param string|null $fileName
     * @param array       $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function imageInput(
        string $name,
        $imageUrlOrDataSource,
        string $title = '',
        string $size = '',
        string $width = '',
        string $height = '',
        string $downloadUrl = null,
        string $fileName = null,
        array $attributes = []
    ) {
        $imgUrl = data_get($imageUrlOrDataSource, $name, '');

        $imgBlock = app(ElementsFactory::class)->imageInput([
            'name' => $name,
            'img_url' => $imgUrl,
            'size' => $size,
            'width' => $width,
            'height' => $height,
            'title' => $title,
        ])->attrs($attributes);

        if (!is_null($downloadUrl)) {
            $imgBlock->downloadUrl($downloadUrl);
        }

        if (!is_null($fileName)) {
            $imgBlock->fileName($fileName);
        }
        $this->getContentPart()->addContent($imgBlock);

        return $this;
    }

    /**
     * Set success notification status
     *
     * @param bool $status
     *
     * @return $this
     */
    public function successNotification(bool $status = true)
    {
        $this->getForm()->successNotifications($status);

        return $this;
    }

    /**
     * Set success notification status
     *
     * @param bool $status
     *
     * @return $this
     */
    public function errorNotification(bool $status = true)
    {
        $this->getForm()->errorNotifications($status);

        return $this;
    }

    /**
     * Add new form group
     *
     * @param string $labelTxt
     * @param string $labelId
     *
     * @return FormGroup
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareNextFormGroup(string $labelTxt = '', string $labelId = '', string $class = 'clearfix')
    {
        return $this->getContentPart()->addElement()
            ->formGroup()->labelTxt($labelTxt)->labelId($labelId)->content('')->class($class);
    }

    /**
     * Get data from source
     *
     * @param $source
     * @param $key
     * @return mixed
     */
    protected function getData($source, $key)
    {
        return is_array($source) || $source instanceof ArrayAccess ? data_get($source, $key, '') : $source;
    }

    /**
     * Render current component and return result string
     *
     * @return string
     */
    public function render(): string
    {
        return $this->form->render();
    }

    /**
     * Convert current object to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}

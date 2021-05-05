<?php


namespace Webmagic\Dashboard\Core\Content;

use Exception;
use Illuminate\Support\Collection;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldNotValidException;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\Content\Exceptions\UnacceptableValueException;
use Webmagic\Dashboard\Elements\Factories\ElementsCreateAbleContract;
use Webmagic\Dashboard\Core\SimpleStringRenderableElement;
use Illuminate\Contracts\Support\Renderable as LaravelRenderable;

trait ContentFieldsUsableTrait
{
    use ClassAvailableTrait;

    /** @var  array Sections available in page */
    protected $available_fields = [
        'name' => [
            'type'              => '',       // any variable type or class string, bool, renderable, array, collection
            'default'           => 'value',  // default value for field
            'acceptable_values' => [],       // array of available values
            'array_acceptable'  => false,    // additional show if array field acceptable,
            'dynamic'           => false     //  will set automatically for all dynamic fields
        ],
    ];

    /**
     * @var string Default filed name. Will be used when the field name not specified
     */
    protected $default_field;

    /** @var  array */
    protected $fields_content;


    /**
     * ContentFieldsUsable constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    public function __construct($content = null)
    {
        if (!is_null($content)) {
            $this->content($content);
        }
    }

    /**
     * Set or get field value
     *
     * @param string $paramName
     * @param $value
     *
     * @return null | ContentFieldsUsable | ElementsCreateAbleContract | mixed
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function param(string $paramName, $value = 'value_not_set_5cf1220ee1df22.49722578')
    {
        //Exception if not valid
        $this->validateFieldName($paramName);

        if ($value === 'value_not_set_5cf1220ee1df22.49722578') {
            return $this->getFieldValue($paramName);
        }

        $this->setFieldContent($value, $paramName);

        return $value instanceof ContentFieldsUsable ? $value : $this;
    }


    /**
     * Set content to default section or get value of default field
     *
     * @param string|Renderable|array $content
     *
     * @param array                   $additionalValues
     *
     * @return mixed | ContentFieldsUsable | ElementsCreateAbleContract
     * @throws NoOneFieldsWereDefined
     */
    public function content($content = 'value_not_set_5cf1220ee1df22.49722578', ... $additionalValues)
    {
        // Set default value
        if ($content === 'value_not_set_5cf1220ee1df22.49722578') {
            return $this->getDefaultFieldContent();
        }

        // Set element attributes with key/value when only one array added and key is available
        if (count($additionalValues) === 0 && is_array($content)) {
            $key = key($content);

            // Check the key is exists
            if($this->isFieldAvailable($key) && !is_numeric($key)){
                foreach ($content as $fieldName => $fieldContent) {
                    $this->setFieldContent($fieldContent, $fieldName);
                }

                return $this;
            }
        }

        // Add content in loop if additional elements added
        if (count($additionalValues) > 0 || is_array($content)) {
            $this->addContent($content);

            foreach ($additionalValues as $fieldContent) {
                $this->addContent($fieldContent);
            }

            return $this;
        }

        // Simple set content
        $this->setFieldContent($content);

        return $content instanceof ContentFieldsUsable ? $content : $this;
    }

    /**
     * Add possibility to define new field dynamically
     * Additionally set or get field value functionality
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function attr(string $name, string $value = 'value_not_set_5cf1220ee1df22.49722578')
    {
        if (!$this->isFieldAvailable($name)) {
            $this->addDynamicField($name);
        }

        if ($value === 'value_not_set_5cf1220ee1df22.49722578') {
            return $this->param($name);
        }

        return $this->param($name, $value);
    }

    /**
     * Set all the attributes from the array
     *
     * @param array $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function attrs(array $attributes)
    {
        foreach ($attributes as $name => $val) {
            $this->attr($name, $val);
        }

        return $this;
    }

    /**
     * Possibility to work with data attributes without entering "data" prefix
     * The functionality is the same as for attr function
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dataAttr(string $name, string $value = null)
    {
        $fullName = "data-$name";

        return $this->attr($fullName, $value);
    }

    /**
     * Set all the data attributes from the array
     *
     * @param array $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function dataAttrs(array $attributes)
    {
        foreach ($attributes as $name => $val) {
            $this->dataAttr($name, $val);
        }

        return $this;
    }

    /**
     * Get value for default field
     *
     * @return string
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function getDefaultFieldContent()
    {
        $fieldName = $this->getDefaultField();

        return $this->getFieldValue($fieldName);
    }

    /**
     * Set content to field
     *
     * @param string|Renderable|array $content
     * @param string|null             $name
     *
     * @param bool                    $validate
     *
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function setFieldContent($content, string $name = null, $validate = true)
    {
        //Use default section if section name is unknown
        if (is_null($name)) {
            $name = $this->getDefaultField();
        }

        //We will have exception here if value is not valid
        if ($validate) {
            $this->isFieldValid($name, $content);
        }

        //Check if we have defined method for set param
        $method = $this->prepareAttributeSetMethod($name);

        if (method_exists($this, $method)) {
            $this->{$method}($content);
            return;
        }

        //All are valid and we may define value
        if ($this->isFieldAcceptArray($name) && !is_iterable($content)) {
            $this->{$name} = [$content];
            return;
        }

        $this->{$name} = $content;
    }

    /**
     * Add value to current
     * May be used for prepend or for push
     *
     * @param             $content
     * @param string|null $name
     *
     * @param bool        $prepend
     *
     * @return ContentFieldsUsable | ElementsCreateAbleContract
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    public function addContent($content, string $name = null, $prepend = false)
    {
        // Use default section if section name is unknown
        if (is_null($name)) {
            $name = $this->getDefaultField();
        }

        // We will have exception here if value is not valid
        $this->isFieldValid($name, $content);

        // Value of param if exists
        $currentValue = $this->getFieldValue($name);

        // Just set value if it was empty before
        if (empty($currentValue)) {
            $this->setFieldContent($content, $name, false);

            return $content instanceof ContentFieldsUsable ? $content : $this;
        }

        // Collect items
        if ($this->isRenderableCollectionAvailable($name, $currentValue, $content)) {
            $currentValue = $this->addToRenderableCollection($content, $currentValue, $prepend);
        } else {
            $currentValue = $this->addToArrayCollection($content, $currentValue, $prepend);
        }

        $this->setFieldContent($currentValue, $name, false);

        return $content instanceof ContentFieldsUsable ? $content : $this;
    }

    /**
     * Check if it is possible to use Renderable collection
     *
     * @param       $fieldName
     * @param mixed ...$params
     *
     * @return bool
     * @throws NoOneFieldsWereDefined
     */
    protected function isRenderableCollectionAvailable($fieldName, ... $params)
    {
        if ($this->isFieldAcceptArray($fieldName)) {
            return false;
        }

        foreach ($params as $param) {
            if (!is_string($param) && !($param instanceof LaravelRenderable)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Use renderable collection for add item
     *
     * @param      $content
     * @param      $currentValue
     * @param bool $prepend
     *
     * @return RenderableCollection
     * @throws Exception
     */
    protected function addToRenderableCollection($content, $currentValue, $prepend = false)
    {
        // Make sure that we work with array
        if (!($currentValue instanceof RenderableCollection)) {
            $currentValue = (new RenderableCollection())->addItem($currentValue);
        }

        // Add item to array
        if ($prepend) {
            $currentValue->prependItem($content);
        } else {
            $currentValue->addItem($content);
        }

        return $currentValue;
    }

    /**
     * Use array to collect items
     *
     * @param      $content
     * @param      $currentValue
     * @param bool $prepend
     *
     * @return array
     */
    protected function addToArrayCollection($content, $currentValue, $prepend = false)
    {
        // Make sure that we work with array
        $currentValue = array_wrap($currentValue);

        // Add item to array
        if ($prepend) {
            array_unshift($currentValue, $content);
        } else {
            array_push($currentValue, $content);
        }

        return $currentValue;
    }

    /**
     * Check if field accept array
     *
     * @param string $fieldName
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     */
    protected function isFieldAcceptArray(string $fieldName)
    {
        $type = $this->getFieldType($fieldName);
        $config = $this->getAvailableFields(true);
        $arrayAcceptable = key_exists($fieldName, $config) && data_get($config[$fieldName], 'array_acceptable', false);

        return $arrayAcceptable || $type == 'array';
    }

    /**
     * Validate field and value
     *
     * @param $name
     * @param $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isFieldValid($name, $value)
    {
        //Validate field name
        $this->validateFieldName($name);

        //Validate field value
        //We will have exception here if value is not valid
        $this->validateFieldValue($name, $value);

        return true;
    }

    /**
     * Validate field name and return exception if it not valid
     *
     * @param $name
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    protected function validateFieldName($name)
    {
        if (!$this->isFieldAvailable($name)) {
            throw new FieldUnavailable($name, $this);
        }
    }

    /**
     * Return default section
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     */
    public function getDefaultField(): string
    {
        if (isset($this->default_field)) {
            return $this->default_field;
        }

        //Will return exception if no one fields defined
        $availableFields = $this->getAvailableFields();

        if ($availableFields === array_values($availableFields)) {
            return array_shift($availableFields);
        }

        return array_first(array_keys($availableFields));
    }

    /**
     * Check if field is available
     *
     * @param string $fieldName
     *
     * @return bool
     * @throws NoOneFieldsWereDefined
     */
    protected function isFieldAvailable(string $fieldName)
    {
        $availableFields = $this->getAvailableFields();

        if (key_exists($fieldName, $availableFields)) {
            return true;
        }

        if (in_array($fieldName, $availableFields)) {
            return true;
        }

        return false;
    }

    /**
     * Validate if field type is valid
     *
     * @param string $name
     * @param        $value
     *
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function validateFieldValue(string $name, $value)
    {
        // Possibility to use custom validation function
        // We will have exception here if value is not valid
        $this->validateFieldValueWithCustomFunctionIfExists($name, $value);

        // Validation by type
        $type = $this->getFieldType($name);

        // We will have exception here if value is not valid
        $customValidateMethod = "isValid$type" . 'Value';

        if ($this->isFieldAcceptArray($name) && $type !== 'array' && is_array($value)) {
            $value = array_first($value);
        }

        // Try to validate type with custom method
        if (method_exists($this, $customValidateMethod)) {
            $this->{$customValidateMethod}($name, $value);
        } elseif (class_exists($type)) {
            if (!($value instanceof $type)) {
                // Check for classes
                throw new FieldNotValidException($name, get_class($value), $type, get_class($this));
            }
        } elseif ($type) {
            // Not known type
            throw new FieldNotValidException($name, gettype($value), $type, get_class($this));
        }

        // Validation for acceptable value
        // We will have exception here if value is not unacceptable
        $this->isFieldValueAcceptable($name, $value);
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function validateFieldValueWithCustomFunctionIfExists(string $name, $value)
    {
        $customFunction = 'isValid' . $name . 'FieldValue';
        if (method_exists($this, $customFunction) && !$this->{$customFunction}($value)) {
            $object = get_class($this);
            throw new Exception("Value of field \"$name\" for $object is invalid");
        }

        return true;
    }

    /**
     * Check if field is acceptable
     *
     * @param string $name
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isFieldValueAcceptable(string $name, $value)
    {
        $availableFields = $this->getAvailableFields();
        if (!isset($availableFields[$name]['acceptable_values'])) {
            return true;
        }

        if (in_array($value, $availableFields[$name]['acceptable_values'])) {
            return true;
        }

        throw new UnacceptableValueException($value, $name, get_class($this));
    }

    /**
     * validate value for string param
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return mixed
     * @throws Exception
     */
    protected function isValidStringValue(string $fieldName, $value)
    {
        if (!is_string($value)) {
            throw new FieldNotValidException($fieldName, gettype($value), 'string', get_class($this));
        }

        return true;
    }

    /**
     * validate value for string param
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return mixed
     * @throws Exception
     */
    protected function isValidArrayValue(string $fieldName, $value)
    {
        if (!is_array($value)) {
            throw new FieldNotValidException($fieldName, gettype($value), 'array', get_class($this));
        }

        return true;
    }

    /**
     * Validate bool value
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isValidBoolValue(string $fieldName, $value)
    {
        if (!is_bool($value)) {
            throw  new FieldNotValidException($fieldName, gettype($value), 'bool', get_class($this));
        }

        return true;
    }

    /**
     * Validate bool value
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isValidCollectionValue(string $fieldName, $value)
    {
        if (!$value instanceof Collection) {
            throw  new FieldNotValidException(
                $fieldName,
                gettype($value),
                '\Illuminate\Support\Collection',
                get_class($this)
            );
        }

        return true;
    }


    /**
     * Validate bool value
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isValidRenderableValue(string $fieldName, $value)
    {
        if (!is_object($value)) {
            throw new FieldNotValidException($fieldName, gettype($value), Renderable::class, get_class($this));
        }

        $interfaces = class_implements($value);
        if (in_array(Renderable::class, $interfaces)) {
            throw new FieldNotValidException($fieldName, gettype($value), Renderable::class, get_class($this));
        }

        return true;
    }

    /**
     * Validate any value
     *
     * @param string $fieldName
     * @param        $value
     *
     * @return bool
     * @throws Exception
     */
    protected function isValidAnyValue(string $fieldName, $value)
    {
        return true;
    }

    /**
     * Get set type for field
     *
     * @param string $fieldName
     *
     * @return string
     * @throws NoOneFieldsWereDefined
     */
    public function getFieldType(string $fieldName): string
    {
        $availableFields = $this->getAvailableFields(true);

        return (string)(
            isset($availableFields[$fieldName]) ? data_get($availableFields[$fieldName],'type',null) : null
        );
    }

    /**
     * Return array with prepared content for render view
     * based on sections names
     *
     * @return array
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function prepareContentsForFields()
    {
        $this->fields_content = [];
        $availableFields = $this->getAvailableFields();
        foreach ($availableFields as $name => $value) {
            if (is_array($value)) {
                $this->prepareFieldValue($name);
            } else {
                $this->prepareFieldValue($value);
            }
        }

        return $this->fields_content;
    }

    /**
     * Prepare dynamic fields additional string
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareDynamicFieldsString()
    {
        $this->fields_content['dynamic_fields'] = '';
        $availableFields = $this->getAvailableFields(true);

        foreach ($availableFields as $name => $config) {
            if (isset($config['dynamic']) && $config['dynamic']) {
                $this->fields_content['dynamic_fields'] .= " $name=\"{$this->prepareFieldValue($name)}\"";
            }
        }

        return $this->fields_content['dynamic_fields'];
    }

    /**
     * Prepare string for data attributes
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareDataAttrFieldsString()
    {
        $this->fields_content['data_fields'] = '';

        $availableFields = $this->getAvailableFields();
        foreach ($availableFields as $fieldName => $fieldData) {
            if (is_string($fieldData) && strpos($fieldData, 'data') === 0 && $fieldData !== 'data') {
                $this->fields_content['data_fields'] .= " $fieldData=\"{$this->prepareFieldValue($fieldData)}\"";
            } elseif (strpos($fieldName, 'data') === 0) {
                $this->fields_content['data_fields'] .= " $fieldName=\"{$this->prepareFieldValue($fieldName)}\"";
            }
        }

        return $this->fields_content['data_fields'];
    }

    /**
     * Convert object to array
     *
     * @return array
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    public function toArray(): array
    {
        $this->prepareContentsForFields();
        $this->prepareDynamicFieldsString();
        $this->prepareDataAttrFieldsString();

        return $this->fields_content;
    }

    /**
     * Prepare field value and set it
     *
     * @param string $name
     *
     * @return string
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function prepareFieldValue(string $name)
    {
        $value = $this->getFieldValue($name);

        //We don`t need to convert array to string
        if (is_iterable($value) && $this->isFieldAcceptArray($name)) {
            return $this->fields_content[$name] = $value;
        }

        return $this->fields_content[$name] = $this->prepareValue($value);
    }

    /**
     * Prepare value
     *
     * @param $value
     *
     * @return string
     */
    protected function prepareValue($value)
    {
        //Recursion for prepare values for array
        if (is_array($value)) {
            $preparedValue = '';
            foreach ($value as $item) {
                $preparedValue .= $this->prepareValue($item);
            }

            return $preparedValue;
        }

        return $value;
    }

    /**
     * Get field value
     *
     * @param string $name
     *
     * @return string
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    protected function getFieldValue(string $name)
    {
        //Result of method if exists
        $method = $this->prepareAttributeGetMethod($name);
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        if (isset($this->{$name})) {
            return $this->{$name};
        }

        return $this->getFieldDefaultValue($name);
    }

    /**
     * Prepare attribute set method
     *
     * @param $attrName
     *
     * @return string
     */
    protected function prepareAttributeSetMethod($attrName)
    {
        return 'set' . ucfirst(camel_case($attrName));
    }

    /**
     * Prepare attribute get method
     *
     * @param $attrName
     *
     * @return string
     */
    protected function prepareAttributeGetMethod($attrName)
    {
        return 'get' . ucfirst(camel_case($attrName));
    }

    /**
     * @param string $fieldName
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     * @throws Exception
     */
    public function getFieldDefaultValue(string $fieldName)
    {
        $availableFields = $this->getAvailableFields(true);

        //Return default if it is set
        if (!in_array($fieldName, $availableFields) && isset($availableFields[$fieldName]['default'])) {
            return $availableFields[$fieldName]['default'];
        }

        $type = $this->getFieldType($fieldName);

        //Default value if renderable type
        if ($type == 'renderable') {
            return new SimpleStringRenderableElement('');
        }

        //Default value if string
        if ($type == 'string') {
            return '';
        }

        //Default for bool
        if ($type == 'bool') {
            return false;
        }

        //Default for bool
        if ($type == 'array') {
            return [];
        }

        //Default for collection
        if ($type == 'collection') {
            return new Collection();
        }

        //Default for 'any' and if type undefined
        return '';
    }

    /**
     * Return available section in current page
     *
     * @param bool $withConfig
     *
     * @return array
     * @throws NoOneFieldsWereDefined
     */
    public function getAvailableFields(bool $withConfig = false): array
    {
        if (!isset($this->available_fields) || !count($this->available_fields)) {
            throw new NoOneFieldsWereDefined($this);
        }

        if ($withConfig) {
            return $this->available_fields;
        }

        $fieldsNames = [];
        foreach ($this->available_fields as $key => $field) {
            $fieldsNames[] = is_array($field) ? $key : $field;
        }

        return $fieldsNames;
    }

    /**
     * Add new field to available fields
     *
     * @param string $name
     * @param array  $parameters
     */
    protected function addDynamicField(string $name, array $parameters = [])
    {
        $parameters = array_merge($parameters, ['dynamic' => true]);

        $this->available_fields[$name] = $parameters;
    }

    /**
     * Dump current element
     *
     *
     * @param bool $dump
     */
    public function dd(bool $dump = false)
    {
        $dump ? dump($this) : dd($this);
    }


    /**
     * Set or get params on __call
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __call($name, $arguments)
    {
        $param = snake_case($name);

        // Add value if set
        if (strpos($param, 'add') !== false) {
            $param = str_replace('add_', '', $param);
            return $this->addContent(
                count($arguments) > 1 ? $arguments : array_shift($arguments),
                $param
            );
        }

        $argumentsCount = count($arguments);

        // Return value if no arguments
        if ($argumentsCount === 0) {
            return $this->param($param);
        }

        // Set param
        return $this->param(
            $param,
            count($arguments) > 1 ? $arguments : array_shift($arguments)
        );
    }

    /**
     * Magic getter
     *
     * @param $param
     *
     * @return ElementsCreateAbleContract|ContentFieldsUsable
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __get($param)
    {
        return $this->param($param);
    }
}

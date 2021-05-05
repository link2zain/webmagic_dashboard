<?php


namespace Webmagic\Dashboard\Core\Content;


use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;

trait AttributesAvailableTrait
{
    /**
     * Add possibility to define new field dynamically
     * Additionally set or get field value functionality
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return mixed|ContentFieldsUsableTrait|CreatesElements|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function attr(string $name, string $value = null)
    {
        if (!$this->isFieldAvailable($name)) {
            $this->addDynamicField($name);
        }

        if (is_null($value)) {
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
     * @return mixed|ContentFieldsUsableTrait|CreatesElements|null
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
}

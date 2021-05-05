<?php


namespace Webmagic\Dashboard\Core\Content;


trait ClassAvailableTrait
{
    /** @var string Attribute for storing classes */
    protected $attributeName = 'class';

    /**
     * Add new class
     *
     * @param string $class
     *
     * @return mixed
     */
    public function addClass(string $class)
    {
        $class = $this->prepareClass($class);

        if (!$this->isFieldAvailable($this->attributeName)) {
            $this->addDynamicField($this->attributeName, ['type' => 'string']);
        }

        return $this->addContent($class, $this->attributeName);
    }

    /**
     * Fully update current class string
     *
     * @param string $class
     *
     * @return mixed
     */
    public function updateClass(string $class)
    {
        return $this->attr($this->attributeName, $class);
    }

    /**
     * Remove class from the classes collection
     *
     * @param string $class
     *
     * @return mixed
     * @throws Exceptions\FieldUnavailable
     * @throws Exceptions\NoOneFieldsWereDefined
     */
    public function removeClass(string $class)
    {
        $class = $this->prepareClass($class);
        $current = $this->classAsString();

        $new  = str_replace([" $class", "$class"], '', $current);

        return $this->attr('class', $new);
    }

    /**
     * Remove one class and add another
     *
     * @param string $basicClass
     * @param string $replaceWith
     *
     * @return mixed
     * @throws Exceptions\FieldUnavailable
     * @throws Exceptions\NoOneFieldsWereDefined
     */
    public function replaceClass(string $basicClass, string $replaceWith)
    {
        $this->removeClass($basicClass);
        return $this->addClass($replaceWith);
    }

    /**
     * Return all class collection as array
     *
     * @return array
     */
    public function classAsArray(): array
    {
        $current = $this->attr($this->attributeName);

        if (is_array($current)) {
            return $current;
        }

        return explode(' ', $current);
    }

    /**
     * Convert classes collection to string
     *
     * @return string
     */
    public function classAsString(): string
    {
        $current = $this->classAsArray();

        return implode(' ', $current);
    }

    /**
     * Prepare class value
     *
     * @param string $value
     *
     * @return string
     */
    protected function prepareClass(string $value)
    {
        return str_start($value, ' ');
    }
}

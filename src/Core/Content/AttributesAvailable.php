<?php


namespace Webmagic\Dashboard\Core\Content;


interface AttributesAvailable
{
    /**
     * Set the attribute value
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return mixed
     */
    public function attr(string $name, string $value);

    /**
     * Set the data attribute value
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return mixed
     */
    public function dataAttr(string $name, string $value);

    /**
     * Set all the attributes from the array
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function attrs(array $attributes);

    /**
     * Set all the data attributes from the array
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function dataAttrs(array $attributes);
}

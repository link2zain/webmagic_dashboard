<?php

namespace Webmagic\Dashboard\Core\Content;

use Webmagic\Dashboard\Elements\Factories\ElementsCreateAbleContract;

interface ContentFieldsUsable
{
    /**
     * Return all available fields
     * With possibility to get full config also
     *
     * @param bool $withConfig
     * @return array
     */
    public function getAvailableFields(bool $withConfig = false): array;

    /**
     * Set or get param or params
     *
     * @param string $name
     * @param null $value
     * @return mixed
     */
    public function param(string $name, $value);

    /**
     * Set or get default filed content
     *
     * @param null $content
     *
     * @return mixed|ContentFieldsUsable|ElementsCreateAbleContract
     */
    public function content($content);

    /**
     * Set or get default filed content
     *
     * @param null $content
     * @param string|null $name
     * @param bool $prepend
     * @return mixed
     */
    public function addContent($content, string $name = null, $prepend = false);

    /**
     * Return key for default field
     *
     * @return string
     */
    public function getDefaultField(): string;

    /**
     * Return type available for param
     *
     * @param string $fieldName
     * @return string
     */
    public function getFieldType(string $fieldName): string;

    /**
     * Return default value for field
     *
     * @param string $name
     * @return mixed
     */
    public function getFieldDefaultValue(string $name);

    /**
     * Return all params as array
     *
     * @return array
     */
    public function toArray(): array;
}

<?php


namespace Webmagic\Dashboard\Core\Content;


interface ClassAvailable
{
    /**
     * Add new class
     *
     * @param string $class
     *
     * @return mixed
     */
    public function addClass(string  $class);

    /**
     * Fully update current class string
     *
     * @param string $class
     *
     * @return mixed
     */
    public function updateClass(string $class);

    /**
     * Remove class from the classes collection
     *
     * @param string $class
     *
     * @return mixed
     */
    public function removeClass(string $class);

    /**
     * Return all class collection as array
     *
     * @return array
     */
    public function classAsArray(): array;

    /**
     * Convert classes collection to string
     *
     * @return string
     */
    public function classAsString(): string;

    /**
     * Remove one class and add another
     *
     * @param string $basicClass
     * @param string $replaceWith
     *
     * @return mixed
     */
    public function replaceClass(string $basicClass, string $replaceWith);
}

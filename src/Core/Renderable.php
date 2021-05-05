<?php


namespace Webmagic\Dashboard\Core;

interface Renderable extends \Illuminate\Contracts\Support\Renderable
{
    /**
     * Render current component and return result string
     *
     * @return string
     */
    public function render(): string;

    /**
     * Convert current object to string
     *
     * @return string
     */
    public function __toString(): string;
}

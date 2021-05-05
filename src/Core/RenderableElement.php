<?php


namespace Webmagic\Dashboard\Core;

use Webmagic\Dashboard\Core\Renderable;

abstract class RenderableElement implements Renderable
{
    /**
     * Render current component and return result string
     *
     * @return string
     */
    abstract public function render(): string;

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

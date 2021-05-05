<?php


namespace Webmagic\Dashboard\Core;

use Webmagic\Dashboard\Core\View\ViewUsableContract;

abstract class AbstractComplexRenderableElement extends RenderableElement implements ViewUsableContract
{
    /**
     * @return string
     */
    public function render(): string
    {
        $view = $this->getViewName();
        $content = $this->getViewData();

        return view($view, $content);
    }

    /**
     * Return path to view
     *
     * @return string
     */
    abstract public function getViewName(): string;

    /**
     * Return all the data which need for render the view
     *
     * @return array
     */
    abstract public function getViewData(): array;
}

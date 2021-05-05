<?php


namespace Webmagic\Dashboard\Pages;

use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\View\ViewUsableContract;

abstract class AbstractPage implements Renderable, ViewUsableContract
{
    /**
     * @inheritDoc
     * @return string
     */
    public function render(): string
    {
        $view = $this->getViewName();
        $content = $this->getViewData();

        return view($view, $content);
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
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

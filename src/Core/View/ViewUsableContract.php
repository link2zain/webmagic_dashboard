<?php

namespace Webmagic\Dashboard\Core\View;

interface ViewUsableContract
{
    /**
     * Return view name
     *
     * @return string
     */
    public function getViewName(): string;

    /**
     * Return all the data which need for render the view
     *
     * @return array
     */
    public function getViewData(): array;
}

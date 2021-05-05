<?php


namespace Webmagic\Dashboard\Core\View;

trait ViewUsable
{
    /** @var  string View for page */
//    protected $view;

    /**
     * Return view for current page
     * @return mixed
     * @throws ViewUndefined
     */
    public function getViewName(): string
    {
        if (isset($this->view) && view()->exists($this->view)) {
            return $this->view;
        }

        throw new ViewUndefined($this);
    }
}

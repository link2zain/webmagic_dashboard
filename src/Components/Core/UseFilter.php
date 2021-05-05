<?php


namespace Webmagic\Dashboard\Components\Core;


use Webmagic\Dashboard\Components\FilterGenerator;
use Webmagic\Dashboard\Elements\Forms\Form;

trait UseFilter
{
    /** @var FilterGenerator */
    protected $filterGenerator;

    /**
     * @param string               $filterUpdateBlockId
     * @param mixed|null $parent
     * @param Form|null            $filter
     *
     * @return $this
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    protected function setFilter(string $filterUpdateBlockId, $parent = null, Form $filter = null)
    {
        $this->filterGenerator = new FilterGenerator($filterUpdateBlockId, $parent, $filter);

        return $this;
    }
    
    /**
     * Return filter form
     *
     * @return Form
     */
    public function getFilter(): Form
    {
        return $this->getFilterGenerator()->getFilter();
    }

    /**
     * @return FilterGenerator
     */
    public function getFilterGenerator(): FilterGenerator
    {
        return $this->filterGenerator;
    }
}

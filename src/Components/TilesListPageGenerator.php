<?php


namespace Webmagic\Dashboard\Components;


use Webmagic\Dashboard\Components\Core\UsePage;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Pages\BasePage;

class TilesListPageGenerator extends TilesListGenerator
{
    use UsePage;

    /**
     * TilesListPageGenerator constructor.
     *
     * @param BasePage|null $page
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct(BasePage $page = null)
    {
        parent::__construct();

        $this->setPage($page);
    }

    /**
     * Prepare page content
     *
     * @return string
     */
    public function prepareContent()
    {
        return parent::render();
    }

    /**
     * Render current component and return result string
     *
     * @return string
     * @throws NoOneFieldsWereDefined
     */
    public function render(): string
    {
        $this->getPage()->content($this->prepareContent());

        return $this->getPage();
    }
}

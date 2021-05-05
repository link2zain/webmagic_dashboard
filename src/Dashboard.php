<?php


namespace Webmagic\Dashboard;

use Exception;
use Webmagic\Dashboard\Elements\Menus\MainMenu\MainMenu;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Pages\BasePage;
use Webmagic\Dashboard\Pages\PagesFactory;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method BasePage headerLogo($valueOrConfig)
 * @method BasePage addHeaderLogo($valueOrConfig)
 * @method BasePage headerNav($valueOrConfig)
 * @method BasePage addHeaderNav($valueOrConfig)
 * @method BasePage mainSidebar($valueOrConfig)
 * @method BasePage addMainSidebar($valueOrConfig)
 * @method BasePage contentHeader($valueOrConfig)
 * @method BasePage addContentHeader($valueOrConfig)
 * @method BasePage content($valueOrConfig)
 * @method BasePage addContent($valueOrConfig)
 * @method BasePage footer($valueOrConfig)
 * @method BasePage addFooter($valueOrConfig)
 * @method BasePage title($valueOrConfig)
 * @method BasePage addTitle($valueOrConfig)
 *
 ********************************************************************************************************************/

class Dashboard implements Renderable
{
    /** @var BasePage */
    protected $page;

    /** @var MainMenu */
    protected $mainMenu;

    /**
     * Dashboard constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $pageFactory = app()->make(PagesFactory::class);
        $this->page = $pageFactory->prepareDefaultPage();

        $this->mainMenu = app()->make(MainMenu::class);
    }

    /**
     * @deprecated
     *
     * @return mixed
     */
    public function getMainMenu()
    {
        return $this->mainMenu();
    }

    /**
     * Get or set main menu
     *
     * @param MainMenu|null $mainMenu
     *
     * @return mixed
     */
    public function mainMenu(MainMenu $mainMenu = null)
    {
        if(is_null($mainMenu)) {
            return $this->mainMenu;
        }

        $this->mainMenu = $mainMenu;
    }

    /**
     * Return current page link
     *
     * @param BasePage|null $page
     *
     * @return BasePage
     */
    public function page(BasePage $page = null)
    {
        if (is_null($page)) {
            return $this->page;
        }

        $this->page = $page;
    }

    /**
     * Render all page content
     *
     * @return string
     */
    public function render() :string
    {
        return $this->page->render();
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
     * Call method on real page
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->page, $method], $arguments);
    }
}

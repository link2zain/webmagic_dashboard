<?php


namespace Webmagic\Dashboard\Pages;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Webmagic\Dashboard\Elements\Menus\MainMenu\MainMenu;
use Webmagic\Dashboard\Elements\Menus\NavBarMenu\NavBarMenu;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Links\LinkButton;
use Webmagic\Dashboard\Elements\Special\LogoLinkElement;

class PagesFactory
{
    /**
     * Path for config
     * @var string
     */
    protected $configPath = 'webmagic.dashboard.dashboard';

    /**
     * @param null $content
     *
     * @return Page
     * @throws Exception
     */
    public function prepareDefaultPage($content = null)
    {
        $page = $this->preparePage(BasePage::class);
        $page->content($content);

        return $page;
    }

    /**
     * @param array $tableData
     *
     * @return Page
     * @throws Exception
     */
    public function prepareTablePage(array $tableData)
    {
        $box = app()->make(Box::class);

        //Prepare add button
        if (isset($tableData['addButton'])) {
            $box = $this->prepareAddButton($tableData['addButton'], $box);
            unset($tableData['addButton']);
        }

        $table = app()->makeWith(Table::class, ['content' => $tableData]);
        $box->content($table);

        $page = $this->preparePage(BasePage::class);
        $page->content($box);

        return $page;
    }

    /**
     * Prepare and add Add button to box
     *
     * @param     $link
     * @param Box $box
     *
     * @return Box
     * @throws Exception
     */
    protected function prepareAddButton($link, Box $box)
    {
        $addButton = new LinkButton([
            'content' => 'Add',
            'icon' => 'fas fa-plus',
            'class' => 'btn-success',
            'link' => $link
        ]);

        $box->param('box_tools', $addButton);

        return $box;
    }

    /**
     * Real creation
     *
     * @param $pageClass
     *
     * @return Page
     * @throws Exception
     */
    protected function preparePage($pageClass)
    {
        $defaultParams = $this->prepareDefaultParams();

        $page = app()->makeWith($pageClass, ['content' => $defaultParams]);

        return $page;
    }

    /**
     * Preparing default params for configuring page
     *
     * @return array
     * @throws Exception
     */
    protected function prepareDefaultParams()
    {
        return [
            'header_logo' => $this->createLogoElement(),
            'header_nav' => $this->prepareHeaderNav(),
            'main_sidebar' => $this->prepareMainMenu(),
            'content_header' => '',
            'data' => '',
            'footer' => '',
            'title' => $this->prepareTitle(),
        ];
    }


    /**
     * Creating logo based on config settings
     *
     * @return LogoLinkElement
     * @throws Exception
     */
    protected function createLogoElement()
    {
        //Old logo settings
        $oldHeaderLogoSettings = config("$this->configPath.logo_settings");
        $headerLogoSettings = config("$this->configPath.logo");

        //For back compatibility with old configs
        if(isset($oldHeaderLogoSettings['part_one'])){
            $headerLogoSettings['text'] = $oldHeaderLogoSettings['part_one'] . $oldHeaderLogoSettings['part_two'];
        }

        try {
            $logoElement = new LogoLinkElement($headerLogoSettings);
        } catch (Exception $e) {
            throw new Exception(
                'Error in creating LogoLinkElement. Invalid data for setup. Check config "logo_settings" '
            );
        }

        return $logoElement;
    }

    /**
     * Creating MainMenu with settings from config
     */
    protected function prepareMainMenu()
    {
        return app()->make(MainMenu::class);
    }

    /**
     * Prepare header navigation
     *
     * @return NavBarMenu
     * @throws BindingResolutionException
     */
    protected function prepareHeaderNav()
    {
        return app()->make(NavBarMenu::class);
    }

    /**
     * Prepare title for dashboard
     *
     * @return Repository|mixed
     */
    protected function prepareTitle()
    {
        return config("$this->configPath.title");
    }
}

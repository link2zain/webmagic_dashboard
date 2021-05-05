<?php


namespace Webmagic\Dashboard\Elements\Menus;

use Illuminate\Support\Collection;
use Webmagic\Dashboard\Core\Content\AttributesAvailable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\RenderableElement;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\View\ViewUndefined;
use Webmagic\Dashboard\Core\View\ViewUsable;
use Illuminate\Support\Facades\Gate;

abstract class MenuItem extends RenderableElement implements AttributesAvailable
{
    use ViewUsable,
        ContentFieldsUsableTrait {
        __construct as protected construct;
    }

    /** @var int */
    protected $rank = 100;

    /** @var array */
    protected $routes_activate;

    /** @var array */
    protected $urls_activate;

    /** @var array */
    protected $routes_parts;

    /** @var array */
    protected $url_reg_exps;

    /** @var  Collection */
    protected $sub_items;

    /**
     * @var bool
     */
    protected $active;

    /**
     * MenuItem constructor.
     *
     * @param null $content
     *
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->sub_items = new Collection();

        if (isset($content['active_rules'])) {
            $this->setRules($content['active_rules']);

            unset($content['active_rules']);
        }

        $this->construct($content);
    }

    /**
     * Check on access with Gates of laravel
     *
     * @return bool
     */
    public function checkOnAccess(): bool
    {
        if (empty($this->gates)) {
            return true;
        }

        foreach ($this->gates as $gate) {
            if (Gate::allows($gate)) {
                return true;
            }
        }

        return false;
    }


    /**
     * @return string
     * @throws ViewUndefined
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function render(): string
    {
        $view = $this->getViewName();

        $content = $this->prepareItem();

        return view($view, ['item' => $content]);
    }

    /**
     * Preparing item array
     *
     * @return array
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    protected function prepareItem()
    {
        //check on active attribute
        $this->prepareActiveStatus();

        // first call this function
        // for set up sub items and active elements
        $prepared_sub_items = $this->prepareSubItems();

        $content = $this->prepareContentsForFields();

        $content['sub_items'] = $prepared_sub_items;

        return $content;
    }

    /**
     * @return int
     * @throws FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function getItemRank(): int
    {
        return $this->param('rank');
    }


    protected function sortSubItems()
    {
        $this->sub_items = $this->sub_items->sortByDesc(function ($item) {
            return $item->getItemRank();
        });
    }

    /**
     * Sorting by param rank
     *
     * @param $a
     * @param $b
     * @return int
     */
    protected function compareRank($a, $b)
    {
        if ($a->getItemRank() == $b->getItemRank()) {
            return 0;
        }

        return ($a->getItemRank() < $b->getItemRank()) ? 1 : -1;
    }

    /**
     * Prepare sub_items
     *
     * @param MenuItem $sub_item
     */
    public function addSubItem(MenuItem $sub_item)
    {
        $this->sub_items->push($sub_item);
    }

    protected function prepareSubItems()
    {
        $this->sortSubItems();

        $prepared_sub_items = [];

        foreach ($this->sub_items as $item) {
            $prepared_sub_items[] = $item->prepareItem();
            //set active
            //checking if sub_item is active set this element active too   m
            if ($item->isActive()) {
                $this->setActive();
                $this->setOpen();
            }
        }

        $this->fields_content['sub_items'] = $prepared_sub_items;

        return $prepared_sub_items;
    }

    /**
     * Preparing active status
     */
    public function prepareActiveStatus()
    {
        if ($this->isActive()) {
            $this->setActive();
        } else {
            $this->setInactive();
        }
    }

    /**
     * Check on active
     *
     * @return bool
     */
    public function isActive()
    {
        // if not set that's mean checking was done before
        if (isset($this->active)) {
            return $this->active;
        }

        // check on active by rules
        return $this->checkActivityByRules();
    }

    /**
     * Check on active
     *
     * @return bool
     */
    protected function checkActivityByRules(): bool
    {
        // active attribute is not set and we run checking
        if ($this->isActiveByUrls()) {
            return true;
        }

        if ($this->isActiveByRoutes()) {
            return true;
        }

        if ($this->isActiveByRoutesParts()) {
            return true;
        }

        if ($this->isActiveByUrlRegExps()) {
            return true;
        }

        return false;
    }

    /**
     * Mark menu item active
     */
    public function setActive()
    {
        $this->active = true;
    }

    /**
     * Mark menu item not active
     */
    public function setInactive()
    {
        $this->active = false;
    }

    /**
     * Set menu item open
     */
    public function setOpen()
    {
        $this->open = true;
    }

    /**
     * Add rules
     *
     * @param array $rules
     */
    public function addRules(array $rules)
    {
        $this->setRules($rules);
    }

    /**
     * Set rules by variables
     * @param $rules
     */
    protected function setRules($rules)
    {
        if (isset($rules['routes'])) {
            $this->routes_activate = $rules['routes'];
        }
        if (isset($rules['urls'])) {
            $this->urls_activate = $rules['urls'];
        }
        if (isset($rules['routes_parts'])) {
            $this->routes_parts = $rules['routes_parts'];
        }
        if(isset($rules['url_reg_exps'])){
            $this->url_reg_exps = $rules['url_reg_exps'];
        }
    }

    /**
     * Check on active by url
     *
     * @return bool
     */
    protected function isActiveByUrls()
    {
        if (!$this->urls_activate) {
            return false;
        }


        $rules = array_wrap($this->urls_activate);

        return in_array(request()->path(), $rules) || in_array(request()->url(), $rules);
    }

    /**
     * Check on active by route name
     *
     * @return bool
     */
    protected function isActiveByRoutes()
    {
        if (!$this->routes_activate) {
            return false;
        }

        $rules = array_wrap($this->routes_activate);
        $route_name = request()->route()->getName();

        return in_array($route_name, $rules);
    }

    /**
     * Check on active by part of route name
     *
     * @return bool
     */
    protected function isActiveByRoutesParts()
    {
        if (!$this->routes_parts) {
            return false;
        }

        $route_name = request()->route()->getName();

        foreach ($this->routes_parts as $group) {
            if (strpos($route_name, $group) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check on active by part of route name
     *
     * @return bool
     */
    protected function isActiveByUrlRegExps()
    {
        if (!$this->url_reg_exps) {
            return false;
        }

        $currentUrl = url()->current();

        $url_reg_exps = array_wrap($this->url_reg_exps);

        foreach ($url_reg_exps as $reg_exp){
            if(preg_match("/$reg_exp/", $currentUrl)){
                return true;
            };
        }

        return false;
    }
}

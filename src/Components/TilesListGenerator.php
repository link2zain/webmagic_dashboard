<?php


namespace Webmagic\Dashboard\Components;

use Closure;
use Exception;
use Illuminate\Pagination\AbstractPaginator;
use Webmagic\Dashboard\Components\Core\UseFilter;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\DataStructures\ConfigurableCollection;
use Webmagic\Dashboard\Core\DataStructures\ConfigurableCollectionContract;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Grid\Grid;

class TilesListGenerator implements Renderable
{
    use UseFilter;

    /** @var ConfigurableCollectionContract */
    protected $itemsCollection;

    /** @var Grid */
    protected $grid;

    /** @var Closure Define the item rendering closure */
    protected $itemRenderingClosure;

    /** @var string Tiles bloc identifier */
    protected $wrapperBlkId;

    /**
     * TilesListGenerator constructor.
     *
     */
    public function __construct()
    {
        $this->itemsCollection = app(ConfigurableCollection::class);
        $this->grid = app(Grid::class);

        $this->setWrapperBlkId();
    }

    /**
     * Set uniq identifier for tiles block
     *
     * @throws NoOneFieldsWereDefined
     */
    protected function setWrapperBlkId()
    {
        $this->wrapperBlkId = 'js_tiles_block_'.uniqid();

        $this->getGrid()->addClass($this->getWrapperBlkId());
    }

    /**
     * @return string
     */
    public function getWrapperBlkId(): string
    {
        return $this->wrapperBlkId;
    }

    /**
     * Add filtering
     *
     * @param bool $inBox
     *
     * @return FilterGenerator
     * @throws NoOneFieldsWereDefined
     * @throws FieldUnavailable
     */
    public function addFiltering(bool $inBox = false)
    {
        $this->setFilter($this->getWrapperBlkId(), $this);

        if ($inBox) {
            $filter = new Box();
            $filter->makeSimple()->content($this->getFilter());
        } else {
            $filter = $this->getFilter();
        }

        $this->getGrid()->param('before_grid', $filter);

        return $this->getFilterGenerator();
    }

    /**
     * Prepare pagination
     *
     * @param AbstractPaginator $paginator
     * @param string            $action
     *
     * @return TilesListGenerator
     */
    public function withPagination(AbstractPaginator $paginator, string $action)
    {
        $grid = $this->getGrid();

        $grid->element('after_grid')
            ->paginator($paginator)
            ->action($action)
            ->resultBlockClass('.'.$this->getWrapperBlkId());

        return $this;
    }


    /**
     * Set items keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return TilesListGenerator
     */
    public function setOnly(...$keys): TilesListGenerator
    {
        $this->itemsCollection->setOnly($keys);

        return $this;
    }

    /**
     * Add keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return TilesListGenerator
     */
    public function addToOnly(...$keys): TilesListGenerator
    {
        $this->itemsCollection->addToOnly($keys);

        return $this;
    }

    /**
     * Set items preparing config
     *
     * @param array $config
     *
     * @return TilesListGenerator
     */
    public function setConfig(array $config): TilesListGenerator
    {
        $this->itemsCollection->setConfig($config);

        return $this;
    }

    /**
     * Add additional config data
     *
     * @param string $key
     * @param        $value
     *
     * @return TilesListGenerator
     */
    public function addToConfig(string $key, $value): TilesListGenerator
    {
        $this->itemsCollection->addToConfig($key, $value);

        return $this;
    }

    /**
     * Set collection items
     *
     * @param array $items
     *
     * @return TilesListGenerator
     * @throws Exception
     */
    public function setItems(array $items): TilesListGenerator
    {
        $this->itemsCollection->setItems($items);

        return $this;
    }

    /**
     * Return initial items
     *
     * @return array
     */
    public function getInitialItems(): array
    {
        return $this->itemsCollection->getInitialItems();
    }

    /**
     * Return items collection
     *
     * @return ConfigurableCollectionContract
     */
    public function getItemsCollection(): ConfigurableCollectionContract
    {
        return $this->itemsCollection;
    }

    /**
     * Return grid
     *
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }

    /**
     * Return prepared items
     *
     * @return array
     */
    public function getPreparedItems(): array
    {
        $preparedItems = $this->itemsCollection->getPreparedItems();
        $items = [];
        foreach ($preparedItems as $item) {
            $items[] = $this->renderItem($item);
        }

        return $items;
    }

    /**
     * Define item rendering closure
     *
     * @param callable $closure
     *
     * @return TilesListPageGenerator
     */
    public function setItemRenderingClosure(callable $closure): TilesListGenerator
    {
        $this->itemRenderingClosure = $closure;

        return $this;
    }

    /**
     * Render item
     *
     * @param array $item
     *
     * @return string
     */
    protected function renderItem(array $item)
    {
        if (isset($this->itemRenderingClosure)) {
            $closure = $this->itemRenderingClosure;
            return $closure($item);
        }

        return $this->defaultItemRender($item);
    }

    /**
     * Render item to element in default way
     *
     * @param array $item
     *
     * @return string
     */
    protected function defaultItemRender(array $item)
    {
        $element = '';
        foreach ($item as $key => $val) {
            $element .= "<div>$key: $val</div>";
        }

        return $element;
    }

    /**
     * Render current component and return result string
     *
     * @return string
     */
    public function render(): string
    {
        $this->getGrid()->elements($this->getPreparedItems());

        return $this->getGrid()->render();
    }

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

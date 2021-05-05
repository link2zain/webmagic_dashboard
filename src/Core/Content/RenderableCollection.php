<?php


namespace Webmagic\Dashboard\Core\Content;

use Exception;
use Illuminate\Support\Collection;
use Webmagic\Dashboard\Core\Renderable;
use Illuminate\Contracts\Support\Renderable as LaravelRenderable;

class RenderableCollection implements Renderable
{

    /** @var Collection  */
    protected $items;

    /**
     * RenderableCollection constructor.
     */
    public function __construct()
    {
        $this->items = new Collection;
    }


    /**
     * @param $item
     *
     * @return RenderableCollection
     * @throws Exception
     */
    public function addItem($item): RenderableCollection
    {
        $this->validateEntrance($item);

        $this->items->push($item);

        return $this;
    }

    /**
     * @param $item
     *
     * @return $this
     * @throws Exception
     */
    public function prependItem($item)
    {
        $this->validateEntrance($item);

        $this->items->prepend($item);

        return $this;
    }

    /**
     * Validate if Item available for using
     *
     * @param $item
     *
     * @throws Exception
     */
    protected function validateEntrance($item)
    {
        if (!is_string($item) && !($item instanceof Renderable) && !($item instanceof LaravelRenderable)) {
            throw new Exception("The $item should be string or Referable (". get_class($this).')');
        }
    }
    
    /**
     * Return items collection
     *
     * @return Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Return item from collection
     *
     * @param int $index
     * @return mixed
     */
    public function getItem(int $index)
    {
        return $this->items[$index];
    }

    /**
     * Render current component and return result string
     *
     * @return string
     */
    public function render(): string
    {
        $result = '';

        foreach ($this->items as $item) {
            $result .= is_string($item) ? $item : $item->render();
        }

        return $result;
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

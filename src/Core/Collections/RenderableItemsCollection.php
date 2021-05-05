<?php


namespace Webmagic\Dashboard\Core\Collections;


use Illuminate\Contracts\Support\Renderable;

class RenderableItemsCollection implements RenderebleItemsCollectionContract
{
    /** @var array Items collection */
    protected $items = [];

    /**
     * Add item to collection
     *
     * @param Renderable $item
     *
     * @return mixed
     */
    public function addItem(Renderable $item)
    {
        $this->items[] = $item;
    }

    /**
     * Return all items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}

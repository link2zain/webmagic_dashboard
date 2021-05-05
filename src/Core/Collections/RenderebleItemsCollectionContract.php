<?php


namespace Webmagic\Dashboard\Core\Collections;


use Illuminate\Contracts\Support\Renderable;

interface RenderebleItemsCollectionContract
{
    /**
     * Add item to collection
     *
     * @param Renderable $item
     *
     */
    public function addItem(Renderable $item);

    /**
     * Return all items
     *
     * @return array
     */
    public function getItems(): array;
}

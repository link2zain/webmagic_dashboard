<?php


namespace Webmagic\Dashboard\Core;


use Webmagic\Dashboard\Core\Renderable;

class RenderableElementsCollection extends RenderableElement
{

    /** @var array */
    protected $collection = [];

    /**
     * RenderableElementsCollection constructor.
     *
     * @param Renderable[] $renderableElements
     */
    public function __construct(Renderable ...$renderableElements)
    {
        $this->collection = $renderableElements;
    }


    /**
     * @param Renderable[] $renderableElements
     *
     * @return $this
     */
    public function addElement(Renderable ...$renderableElements)
    {
        $this->collection = array_merge($this->collection, $renderableElements);

        return $this;
    }

    /**
     * Render current component and return result string
     *
     * @return string
     */
    public function render(): string
    {
        $result = '';
        foreach ($this->collection as $element){
            $result .= $element->render();
        }

        return $result;
    }
}

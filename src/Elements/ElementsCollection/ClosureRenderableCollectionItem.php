<?php

namespace Webmagic\Dashboard\Elements\ElementsCollection;

use Webmagic\Dashboard\Core\Renderable;

class ClosureRenderableCollectionItem implements Renderable
{

    /** @var \Closure */
    protected $closure;

    /** @var  */
    protected $value;

    /**
     * ClosureRenderableCollectionItem constructor.
     * @param \Closure $closure
     * @param $value
     */
    public function __construct(\Closure $closure, $value)
    {
        $this->closure = $closure;
        $this->value = $value;
    }

    /**
     * Render to string
     *
     * @return string
     */
    public function render(): string
    {
        $closure = $this->closure;

        return (string) $closure($this->value);
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
}

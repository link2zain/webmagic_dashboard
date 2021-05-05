<?php


namespace Webmagic\Dashboard\Elements\Factories;

abstract class Factory extends ElementsFactory
{
    /** @var ElementsFactory */
    protected $mainFactory;

    /** @var array Elements available for generation */
    protected $elements = [];

    /**
     * ElementsFactory constructor.
     * @param ElementsFactory $mainFactory
     */
    public function __construct(ElementsFactory $mainFactory)
    {
        $this->mainFactory = $mainFactory;
    }

    /**
     *  Put container to the stack
     *
     * @param CreatesElements $container
     */
    public function putContainer(CreatesElements $container)
    {
        $this->mainFactory->putContainer($container);
    }

    /**
     * Return previous container in the stack and remove it from stack
     *
     * @return \Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait
     */
    public function getPreviousContainer()
    {
        return $this->mainFactory->getPreviousContainer();
    }

    /**
     * Return all registered elements
     *
     * @return array
     */
    public function getRegistered(): array
    {
        return $this->elements;
    }

    /**
     * Check if element registered
     *
     * @param string $key
     * @return bool
     */
    public function isRegistered(string $key): bool
    {
        return key_exists($key, $this->getRegistered());
    }

    /**
     * Set or get params on __call
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (!key_exists($name, $this->elements)) {
            // Call parent factory if not set in current
            return $this->mainFactory->__call($name, $arguments);
        }

        // Create and configure element
        $element = app($this->elements[$name]);
        if (count($arguments) > 1) {
            $element->content($arguments);
        } elseif (count($arguments) == 1) {
            $element->content($arguments[0]);
        }

        // Save factory for work parent link
        $element = $this->addFactoryToElement($element);

        // Return element if no container defined
        $parentContainer = $this->mainFactory->getCurrentContainer();
        if (is_null($parentContainer)) {
            return $element;
        }

        // Add to container
        $containerParam = $this->mainFactory->getContainerParam();
        if ($this->mainFactory->isAddElement()) {
            return $parentContainer->addContent($element, $containerParam);
        }

        if (is_null($containerParam)) {
            return $parentContainer->content($element);
        }

        return $parentContainer->param($containerParam, $element);
    }

    /**
     * Save factory for work parent link
     *
     * @param $element
     *
     * @return CreatesElements
     */
    protected function addFactoryToElement(CreatesElements $element)
    {
        $element->setFactory($this->mainFactory);

        return $element;
    }
}

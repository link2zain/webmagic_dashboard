<?php


namespace Webmagic\Dashboard\Elements\Factories;


trait CreateElementsTrait
{
    /** @var ElementsFactory */
    protected $factory;


    /**
     * Add element to param
     *
     * @param string|null $param
     * @return ElementsFactory
     */
    public function element(string $param = null): ElementsFactory
    {
        return $this->getFactory($this, $param);
    }

    /**
     * Add element to param
     *
     * @param string|null $param
     * @return ElementsFactory
     */
    public function addElement(string $param = null): ElementsFactory
    {
        return $this->getFactory($this, $param, true);
    }

    /**
     * Return previous container
     *
     * @param null $identifier
     *
     * @return CreatesElements
     * @throws \Exception
     */
    public function parent($identifier = null)
    {
        $previousContainer = $this->getFactory()->getPreviousContainer();
        if (is_null($identifier) || !$previousContainer) {
            return $previousContainer;
        }

        // Search the parent by identifier
        if (!class_exists($identifier)) {
            $identifier = data_get($this->getFactory()->getRegistered(), $identifier, false);

            if (!$identifier) {
                throw new \Exception("$identifier don't know identifier");
            }
        }

        if ($previousContainer instanceof $identifier) {
            return $previousContainer;
        }

        $resultContainer = $previousContainer->parent($identifier);

        if (!$resultContainer) {
            throw new \Exception("Parent $identifier don't found");
        }

        return $resultContainer;
    }

    /**
     * Set elements factory
     *
     * @param ElementsFactory $factory
     */
    public function setFactory(ElementsFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Preapare elements factory
     *
     * @param CreatesElements $container
     * @param string|null     $containerParam
     * @param bool            $addElement
     *
     * @return ElementsFactory
     */
    protected function getFactory(CreatesElements $container = null, string $containerParam = null, bool $addElement = false)
    {
        if (isset($this->factory)) {
            return $this->factory->updateData($container, $containerParam, $addElement);
        }

        return new ElementsFactory($container, $containerParam, $addElement);
    }
}

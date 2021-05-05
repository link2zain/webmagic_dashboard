<?php

namespace Webmagic\Dashboard\Elements\Factories;

interface CreatesElements
{
    /**
     * Set element
     *
     * @param string|null $param
     * @return ElementsFactory
     */
    public function element(string $param = null): ElementsFactory;

    /**
     * Add element
     *
     * @param string|null $param
     * @return ElementsFactory
     */
    public function addElement(string $param = null): ElementsFactory;

    /**
     * Return previous container
     *
     * @param null $identifier
     *
     * @return CreatesElements|null
     */
    public function parent($identifier = null);

    /**
     * Save link to factory
     *
     * @param ElementsFactory $factory
     * @return mixed
     */
    public function setFactory(ElementsFactory $factory);
}

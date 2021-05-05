<?php

namespace Webmagic\Dashboard\Elements\Factories;

interface ElementsRegisterAbleContract
{
    /**
     * Return all registered elements
     *
     * @return array
     */
    public function getRegistered(): array;

    /**
     * Check if element registered
     *
     * @param string $key
     * @return bool
     */
    public function isRegistered(string $key): bool;
}

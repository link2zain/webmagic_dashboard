<?php


namespace Webmagic\Dashboard\Core\DataStructures;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

class ConfigurableCollection implements ConfigurableCollectionContract
{
    /** @var array Inital items */
    protected $initialItems = [[]];

    /** @var array Configuration array */
    protected $config = [];

    /** @var array Array with limitations */
    protected $only = [];

    /**
     * Set items keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return ConfigurableCollectionContract
     */
    public function setOnly(...$keys): ConfigurableCollectionContract
    {
        // Use first item only if it is array
        if (is_array($keys[0])) {
            $keys = $keys[0];
        }

        $this->only = $keys;

        return $this;
    }

    /**
     * Add keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return ConfigurableCollectionContract
     */
    public function addToOnly(...$keys): ConfigurableCollectionContract
    {
        // Use first item only if it is array
        if (is_array($keys[0])) {
            $keys = $keys[0];
        }

        $this->only = array_merge($this->only, $keys);

        return $this;
    }

    /**
     * Set items preparing config
     *
     * @param array $config
     *
     * @return ConfigurableCollectionContract
     */
    public function setConfig(array $config): ConfigurableCollectionContract
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Add additional config data
     *
     * @param string $key
     * @param        $value
     *
     * @return ConfigurableCollectionContract
     */
    public function addToConfig(string $key, $value): ConfigurableCollectionContract
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * Set collection items
     *
     * @param array $items
     *
     * @return ConfigurableCollectionContract
     * @throws \Exception
     */
    public function setItems(array $items): ConfigurableCollectionContract
    {
        $this->validateInitialItems($items);

        $this->initialItems = $items;

        return $this;
    }

    /**
     * Validate the initial items array structure
     *
     * @param array $items
     *
     * @throws \Exception
     */
    protected function validateInitialItems(array $items)
    {
        $firstItem = array_shift($items);

        if (!is_array($firstItem) && !$firstItem instanceof Arrayable) {
            throw new \Exception('Initial items should be set as arrays [ [ ] ] or [ \Illuminate\Contracts\Support\Arrayable ]');
        }
    }

    /**
     * Return initial items
     *
     * @return array
     */
    public function getInitialItems(): array
    {
        return $this->initialItems;
    }

    /**
     * Return items prepared based on config, limitations and other
     *
     * @return array
     */
    public function getPreparedItems(): array
    {
        $availableKeys = $this->prepareAvailableKeys();

        return $this->prepareItemsValues($availableKeys);
    }

    /**
     * Prepare items values based on config, limitations and other
     *
     * @param array $availableKeys
     *
     * @return array
     */
    protected function prepareItemsValues(array $availableKeys): array
    {
        $resultItems = [];

        foreach ($this->initialItems as $item) {
            $itemValues = [];

            foreach ($availableKeys as $key) {
                $itemValues[$key] = $this->prepareItemValue($key, $item);
            }

            $resultItems[] = $itemValues;
        }

        return $resultItems;
    }

    /**
     * Prepare item value based on config
     *
     * @param string $key
     * @param        $item
     *
     * @return mixed
     */
    protected function prepareItemValue(string $key, $item)
    {
        $itemValue = data_get($item, $key, '');

        if (!$this->isConfiguredKey($key)) {
            return $itemValue;
        }

        $configuredValue = $this->config[$key];

        if (is_callable($configuredValue)) {
            return $configuredValue($item);
        }

        return $configuredValue;
    }

    /**
     * Check if the key has configuration
     *
     * @param string $key
     *
     * @return bool
     */
    protected function isConfiguredKey(string $key): bool
    {
        return key_exists($key, $this->config);
    }

    /**
     * Prepare items keys
     *
     * @return array
     */
    protected function prepareAvailableKeys(): array
    {
        if (count($this->only)) {
            return $this->only;
        }

        /** @var Model $firstItem */
        $firstItem = $this->initialItems[0];
        $firstItem = is_array($firstItem) ? $firstItem : $firstItem->toArray();

        $keys = array_keys($firstItem);

        if (count($this->config)) {
            $configKeys = array_keys($this->config);
            $keys = array_merge($keys, $configKeys);
        }

        return $keys;
    }
}

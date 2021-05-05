<?php


namespace Webmagic\Dashboard\Core\DataStructures;


interface ConfigurableCollectionContract
{
    /**
     * Set items keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return mixed
     */
    public function setOnly(... $keys): ConfigurableCollectionContract;

    /**
     * Add keys which should be shown
     *
     * @param mixed ...$keys
     *
     * @return mixed
     */
    public function addToOnly(... $keys): ConfigurableCollectionContract;

    /**
     * Set items preparing config
     *
     * @param array $config
     *
     * @return mixed
     */
    public function setConfig(array $config): ConfigurableCollectionContract;

    /**
     * Add additional config data
     *
     * @param string $key
     * @param $value
     *
     * @return mixed
     */
    public function addToConfig(string $key, $value): ConfigurableCollectionContract;

    /**
     * Set collection items
     *
     * @param array $items
     *
     * @return mixed
     */
    public function setItems(array $items): ConfigurableCollectionContract;

    /**
     * Return initial items
     *
     * @return array
     */
    public function getInitialItems(): array;

    /**
     * Return items prepared based on config, limitations and other
     *
     * @return array
     */
    public function getPreparedItems(): array;
}

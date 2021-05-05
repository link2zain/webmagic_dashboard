<?php

namespace Webmagic\Dashboard\Elements\ElementsCollection;

use Illuminate\Database\Eloquent\Model;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;

abstract class ElementsCollection extends ComplexElement
{
    protected $available_fields = [
        'only' => [
            'type' => 'array',
            'default' => []
        ],
        'config' => [
            'type' => 'array',
            'default' => []
        ],
        'items' => [
            'type' => 'any',
            'default' => [],
            'array_acceptable' => true
        ]
    ];

    /**
     * Set content to default section or get value of default field
     *
     * @param string|\Webmagic\Dashboard\Core\Renderable|array $content
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     * @throws \Exception
     */
    public function content($content = 'value_not_set_5cf1220ee1df22.49722578', ... $additionalValues)
    {
        //This sorting needed because we have depending in order of set the params
        if (is_array($content)) {
            $content = array_sort($content, function ($value, $key) {
                switch ($key) {
                    case ('only'):
                        $position = 0;
                        break;
                    case ('config'):
                        $position = 1;
                        break;
                    default:
                        $position = 10;
                        break;
                }

                return $position;
            });
        }

        parent::content($content);
    }

    /**
     * Prepare and set items
     *
     * @param array $items
     *
     * @return array
     * @throws \Exception
     */
    public function setItems($items)
    {
        return $this->items = $this->prepareItems($items);
    }

    /**
     * Prepare items
     *
     * @param array $items
     *
     * @return array
     * @throws \Exception
     */
    protected function prepareItems($items)
    {
        $preparedItems = [];
        $availableKeys = $this->getAvailableItemFields(array_first($items));
        foreach ($items as $item) {
            $preparedItem = [];
            foreach ($availableKeys as $key) {
                $preparedItem[$key] = $this->prepareItemValue($key, $item);
            }
            $preparedItems[] = $preparedItem;
        }

        return $preparedItems;
    }

    /**
     * Prepare field values
     *
     * @param string $key
     * @param        $item
     *
     * @return mixed|string
     * @throws \Exception
     */
    protected function prepareItemValue(string $key, $item)
    {
        $config = $this->param('config');
        $configValue = data_get($config, $key, null);

        // Create table field for closure work
        if (is_callable($configValue)) {
            return new ClosureRenderableCollectionItem(
                $configValue,
                $item
            );
        }

        // Show just config value if set
        if (!is_null($configValue)) {
            return $configValue;
        };

        $value = data_get($item, $key, '');
        // Render if it is object
        if (is_object($value)) {
            try {
                return $value->__toString();
            } catch (\Exception $e) {
                throw new \Exception("The given value can`t be converted to string: $key => $value");
            }
        }

        // Default work if no configured
        return $value;
    }

    /**
     * Prepare available fields
     *
     * @param array $item
     *
     * @return array|mixed
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    protected function getAvailableItemFields($item)
    {
        if (is_null($item)) {
            return [];
        }

        $only = $this->param('only');

        if (!empty($only)) {
            return $only;
        }

        if ($item instanceof Model) {
            $item = $item->getAttributes();
        }

        $itemKeys = array_keys($item);
        $configKeys = $this->param('config');
        if (empty($configKeys)) {
            return $itemKeys;
        }

        return array_merge($itemKeys, array_keys($configKeys));
    }
}

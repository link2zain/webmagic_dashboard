<?php


namespace Webmagic\Dashboard\Elements\Tables;

use Exception;
use Webmagic\Dashboard\Elements\ElementsCollection\ElementsCollection;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection classes($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addClasses($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection only(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addOnly(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection config(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addConfig(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection items($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addItems($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection bulkActionClosure(Closure $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addBulkActionClosure(Closure $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection bulkActionsId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addBulkActionsId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection attributesClosures($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addAttributesClosures($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection rowClassesArray(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addRowClassesArray(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection attributesClosuresArray(array $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection addAttributesClosuresArray(array $valueOrConfig)
 *
 ********************************************************************************************************************/

class TableRowsCollection extends ElementsCollection
{
    protected $view = 'dashboard::components.tables.table_row';

    /** @var array Classes prepared with closure */
    protected $row_classes_array;

    protected $available_fields = [
        'classes',
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
        ],
        'bulk_action_closure' => [
            'type' => \Closure::class
        ],
        'manual_sorting_closure' => [
            'type' => \Closure::class
        ],
        'bulk_actions_id',
        'manual_sorting_id',
        'attributes_closures'
    ];

    protected $default_field = 'items';

    /**
     * Prepare table items
     *
     * @param array $items
     *
     * @return array
     * @throws Exception
     */
    protected function prepareItems($items)
    {
        // Prepare closure for row classes if defined
        if (is_callable($this->classes)) {
            $this->row_classes_array = [];
            $classesClosure = $this->classes;
        }

        $preparedItems = [];
        $availableKeys = $this->getAvailableItemFields(array_first($items));
        $this->attributes_closures_array = [];
        foreach ($items as $item) {
            // Prepare class for row if closure defined
            if (isset($classesClosure)) {
                $this->row_classes_array[] = $classesClosure($item);
            }

            // Generate attributes by closures
            if (isset($this->attributes_closures)) {
                if (is_callable($this->attributes_closures)) {
                    $closure = $this->attributes_closures;
                    $this->attributes_closures_array[] = is_callable($closure) ? $closure($item) : '';
                } else {
                    foreach ($this->attributes_closures as $closure) {
                        $this->attributes_closures_array[] = is_callable($closure) ? $closure($item) : '';
                    }
                }
            }

            $preparedItem = [];
            foreach ($availableKeys as $key) {
                $preparedItem[$key] = $this->prepareItemValue($key, $item);
            }
            if (isset($this->bulk_action_closure)) {
                $closure = $this->bulk_action_closure;
                $preparedItem['bulk_action_id'] = is_callable($closure) ? $closure($item) : '';
            }
            if (isset($this->manual_sorting_closure)) {
                $closure = $this->manual_sorting_closure;
                $preparedItem['manual_sorting_id'] = is_callable($closure) ? $closure($item) : '';
            }

            $preparedItems[] = $preparedItem;
        }

        return $preparedItems;
    }

    /**
     * Return available section in current page
     *
     * @param bool $withConfig
     *
     * @return array
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function getAvailableFields(bool $withConfig = false): array
    {
        $availableFields = parent::getAvailableFields($withConfig);

        if ($withConfig) {
            $availableFields['row_classes_array'] = [
                'type' => 'array'
            ];
            $availableFields['attributes_closures_array'] = [
                'type' => 'array'
            ];
        } else {
            $availableFields[] = 'row_classes_array';
            $availableFields[] = 'attributes_closures_array';
        }

        return $availableFields;
    }
}

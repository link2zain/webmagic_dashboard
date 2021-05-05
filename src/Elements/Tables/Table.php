<?php


namespace Webmagic\Dashboard\Elements\Tables;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method Table class(string $valueOrConfig)
 * @method Table addClass(string $valueOrConfig)
 * @method Table wrapperClasses($valueOrConfig)
 * @method Table addWrapperClasses($valueOrConfig)
 * @method Table afterTable($valueOrConfig)
 * @method Table addAfterTable($valueOrConfig)
 * @method Table beforeTable($valueOrConfig)
 * @method Table addBeforeTable($valueOrConfig)
 * @method Table titles(array $valueOrConfig)
 * @method Table addTitles(array $valueOrConfig)
 * @method Table rows(Webmagic\Dashboard\Elements\Tables\TableRowsCollection $valueOrConfig)
 * @method Table addRows(Webmagic\Dashboard\Elements\Tables\TableRowsCollection $valueOrConfig)
 * @method Table bulkActions(array $valueOrConfig)
 * @method Table addBulkActions(array $valueOrConfig)
 * @method Table filterArea($valueOrConfig)
 * @method Table addFilterArea($valueOrConfig)
 * @method Table paginationArea($valueOrConfig)
 * @method Table addPaginationArea($valueOrConfig)
 * @method Table bulkActionsArea($valueOrConfig)
 * @method Table addBulkActionsArea($valueOrConfig)
 * @method Table bulkActionsId($valueOrConfig)
 * @method Table addBulkActionsId($valueOrConfig)
 *
 ********************************************************************************************************************/

class Table extends ComplexElement
{
    protected $view = 'dashboard::components.tables.table';

    protected $available_fields = [
        'class' => [
            'type' => 'string',
            'default' => 'table table-hover table-striped'
        ],
        'wrapper_classes',
        'after_table',
        'before_table',
        'titles' => [
            'type' => 'array',
            'default' => []
        ],
        'rows' => [
            'type' => TableRowsCollection::class,
            'default' => [],
        ],
        'bulk_actions' => [
            'type' => 'array',
            'default' => [],
        ],
        'filter_area',
        'pagination_area',
        'bulk_actions_area',
        'bulk_actions_id',
        'tbody_class',
        'manual_sorting_url',
        'manual_sorting_method' => [
            'type' => 'string',
            'default' => 'POST'
        ]
    ];

    protected $default_field = 'rows';

    /**
     * Table constructor.
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        //Set bulk actions identifier
        $this->setBulkActionsId();
    }

    /**
     * Set bulk actions ID
     *
     * @param null $id
     *
     * @return $this
     */
    protected function setBulkActionsId($id = null)
    {
        $this->bulk_actions_id = is_null($id) ? uniqid() : $id;

        return $this;
    }


    /**
     * Set attributes for manual sorting
     *
     * @param string $requestUrl
     * @param string $method
     *
     * @return Table
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function manualSorting(string $requestUrl, string $method = 'POST')
    {
        $this->attrs([
            'tbody_class' => 'js-sortable',
            'manual_sorting_url' => $requestUrl,
            'manual_sorting_method' => $method
        ]);

        return $this;
    }


}

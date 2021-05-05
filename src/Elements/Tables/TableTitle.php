<?php


namespace Webmagic\Dashboard\Elements\Tables;

use Exception;
use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle sortBy($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addSortBy($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle nextSort($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addNextSort($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle action($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addAction($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle method($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle resultReplaceBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addResultReplaceBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle currentSort($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addCurrentSort($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle noneSortingAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle addNoneSortingAvailable(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class TableTitle extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::components.tables.table_title';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'title',
        'sort_by',
        'next_sort' => [
            'default' => 'asc',
            'acceptable_values' => [
                'asc',
                'desc',
                ''
            ]
        ],
        'action',
        'method' => [
            'default' => 'GET'
        ],
        'result_replace_block_class',
        'current_sort' => [
            'default' => 'none',
            'acceptable_values' => [
                'asc',
                'desc',
                'none'
            ]
        ],
        'none_sorting_available' => [
            'type' => 'bool',
            'default' => true
        ]
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'title';

    /**
     * Set next sort value
     *
     * @param $value
     * @return TableTitle
     * @throws Exception
     */
    protected function setCurrentSort($value)
    {
        $this->isFieldValid('current_sort', $value);

        $this->current_sort = $value;

        if ($value == 'asc') {
            $this->next_sort = 'desc';
        } elseif ($value == 'desc' && $this->getFieldValue('none_sorting_available')) {
            $this->nextSort = '';
        } else {
            $this->next_sort = 'asc';
        }

        return $this;
    }
}

<?php


namespace Webmagic\Dashboard\Elements\Grid;


use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Grid\Grid class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid rowClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addRowClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid xsRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addXsRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid smRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addSmRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid mdRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addMdRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid lgRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addLgRowCount($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid elements($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addElements($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid beforeGrid($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addBeforeGrid($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid afterGrid($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid addAfterGrid($valueOrConfig)
 *
 ********************************************************************************************************************/

class Grid extends ComplexElement
{
    protected $view = 'dashboard::components.grid.grid';

    /**
     * Available fields
     *
     * @var array
     */
    protected $available_fields = [
        'class',
        'row_class',
        'xs_row_count' => [
            'default' => '1'
        ],
        'sm_row_count' => [
            'default' => '1'
        ],
        'md_row_count' => [
            'default' => '4'
        ],
        'lg_row_count' => [
            'default' => '6'
        ],
        'elements' => [
            'default' => [],
            'array_acceptable' => true
        ],
        'before_grid',
        'after_grid'
    ];

    protected $default_field = 'elements';

    /**
     * Prepare content for fields
     *
     * With additional blocks sizes calculation
     *
     * @return array
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareContentsForFields()
    {
        $content = parent::prepareContentsForFields();

        $content['xs'] = 12/$content['xs_row_count'];
        $content['sm'] = 12/$content['sm_row_count'];
        $content['md'] = 12/$content['md_row_count'];
        $content['lg'] = 12/$content['lg_row_count'];

        $this->fields_content = $content;

        return $this->fields_content;
    }
}

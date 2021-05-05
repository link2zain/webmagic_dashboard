<?php


namespace Webmagic\Dashboard\Elements;

use Illuminate\Pagination\AbstractPaginator;
use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Paginator paginatedItems(Illuminate\Pagination\AbstractPaginator $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator addPaginatedItems(Illuminate\Pagination\AbstractPaginator $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator perPage($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator addPerPage($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator resultBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator addResultBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator action($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Paginator addAction($valueOrConfig)
 *
 ********************************************************************************************************************/

class Paginator extends ComplexElement
{
    /** @var  StringElement Component view name */
    protected $view = 'dashboard::components._pagination';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'paginated_items' => [
            'type' => AbstractPaginator::class
        ],
        'per_page' => [
            'default' => 10
        ],
        'result_block_class',
        'action'
    ];

    /** @var  StringElement Default section for current component */
    protected $default_field = 'paginated_items';
}

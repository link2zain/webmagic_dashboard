<?php


namespace Webmagic\Dashboard\Elements\Titles;

use Webmagic\Dashboard\Core\ComplexElement;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Titles\H1Title title($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Titles\H1Title addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Titles\H1Title subTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Titles\H1Title addSubTitle($valueOrConfig)
 *
 ********************************************************************************************************************/

class H1Title extends ComplexElement
{
    protected $view = 'dashboard::elements.titles.h1_title';

    protected $available_fields = [
        'title',
        'sub_title'
    ];

    protected $default_field = 'title';
}

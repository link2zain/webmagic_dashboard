<?php

namespace Webmagic\Dashboard\Elements\Graphics;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;


/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic graphicUniqClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addGraphicUniqClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic graphicChangeViewUniqClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addGraphicChangeViewUniqClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic graphicFormClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addGraphicFormClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic dataUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addDataUrl($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic isChangeViewAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addIsChangeViewAvailable(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic isLegendDisplay(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addIsLegendDisplay(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic legendPosition($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addLegendPosition($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic pointRadius($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addPointRadius($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic lineTension($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addLineTension($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic showXAxes(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addShowXAxes(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic showYAxes(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic addShowYAxes(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class Graphic extends ComplexElement
{
    protected $view = 'dashboard::elements.graphics.graphic';

    protected $available_fields = [
        'graphic_uniq_class',
        'graphic_change_view_uniq_class',
        'graphic_form_class',
        'data_url',
        'is_change_view_available' => [
            'type' => 'bool',
            'default' => true
        ],
        'type' => [
            'default' => 'line',
            'acceptable_values' => ['bar', 'line']
        ],
        'is_legend_display' => [
            'type' => 'bool',
            'default' => true
        ],
        'legend_position' => [
            'default' => 'bottom',
            'acceptable_values' => ['bottom','top']
        ],
        'point_radius' => [
            'default' => 0
        ],
        'line_tension' => [
            'default' => 0
        ],
        'show_x_axes' => [
            'type' => 'bool',
            'default' => true
        ],
        'show_y_axes' => [
            'type' => 'bool',
            'default' => true
        ],
    ];

    protected $default_field = 'data_url';

    /**
     * Graphic constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        if(empty($this->graphic_uniq_class)){
            $this->graphic_uniq_class = $this->prepareClass('js_graphic-');
        }

        if(empty($this->graphic_change_view_uniq_class)){
            $this->graphic_change_view_uniq_class = $this->prepareClass('js_graphic-change-');
        }
    }

    /**
     * Prepare uniq ID
     *
     * @return string
     */
    protected function prepareClass(string $prefix = ''): string
    {
        return $prefix.uniqid();
    }


}

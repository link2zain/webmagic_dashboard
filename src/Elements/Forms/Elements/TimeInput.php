<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Illuminate\Support\Carbon;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class TimeInput extends Input
{
    /**
     * Set type file
     *
     * TimeInput constructor.
     * @param null $content
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->type = 'time';

        parent::__construct($content);
    }

    /**
     * Convert value to correct time string
     *
     * @param $value
     * @return string
     */
    protected function setValue($value)
    {
        $this->value = Carbon::parse($value)->toTimeString();
    }
}

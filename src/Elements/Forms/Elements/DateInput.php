<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Illuminate\Support\Carbon;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class DateInput extends Input
{
    /**
     * DateInput constructor.
     *
     * @param null $content
     *
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->type = 'date';

        parent::__construct($content);
    }

    /**
     * Convert date to correct format
     *
     * @param $value
     */
    protected function setValue($value)
    {
        $this->value = Carbon::parse($value)->toDateString();
    }
}

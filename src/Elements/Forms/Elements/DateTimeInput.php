<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Illuminate\Support\Carbon;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class DateTimeInput extends Input
{
    /**
     * DateInput constructor.
     *
     * @param null $content
     *
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->type = 'datetime-local';

        parent::__construct($content);
    }

    /**
     * Convert date to correct format
     *
     * @param $value
     */
    protected function setValue($value)
    {
        $this->value = Carbon::parse($value)->format('Y-m-d\TH:i');
    }
}

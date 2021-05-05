<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Carbon\Carbon;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addName($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker nameEnd($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addNameEnd($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker valueEnd($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addValueEnd($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker range(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addRange(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker requiredEnd(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addRequiredEnd(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker date(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addDate(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker time(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addTime(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker format(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker addFormat(string $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker time24format(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker seconds(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class DateTimePicker extends Input
{
    /** @var  string Component view name */
    protected $view = 'dashboard::elements.forms.elements.date_time_picker';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'id',
        'name',
        'name_end',
        'value',
        'value_end',
        'range' => [
            'type' => 'bool',
            'default' => false
        ],
        'required' => [
            'type' => 'bool',
            'default' => false

        ],
        'required_end' => [
            'type' => 'bool',
            'default' => false

        ],
        'date' => [
            'type' => 'bool',
            'default' => true
        ],
        'time' => [
            'type' => 'bool',
            'default' => false
        ],
        'format' => [
            'type' => 'string',
            'default' => 'Y/MM/DD H:mm'
        ],
        'time24format' => [
            'type' => 'bool',
            'default' => true
        ],
        'seconds' => [
            'type' => 'bool',
            'default' => true
        ]

    ];

    /** @var  string Default section for current component */
    protected $default_field = 'value';

    /**
     * Set start date value
     *
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $this->prepareDate($value);
    }

    /**
     * Set end date value
     *
     * @param Carbon $value
     */
    public function setValueEnd($value)
    {
        $this->value_end = $this->prepareDate($value);
    }

    /**
     * Prepare date format for correct js plugin work
     *
     * @param  $value
     *
     * @return string
     */
    protected function prepareDate($value)
    {
        if (!$value) {
            return $value;
        }

        try {
            return Carbon::parse($value)->format('Y/m/d H:i');
        } catch (\Exception $e) {
            return null;
        }
    }
}

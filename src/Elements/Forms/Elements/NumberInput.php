<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;


use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput id($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput type($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addType($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput required(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addRequired(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput value($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addValue($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput placeholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addPlaceholder($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput name($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput addName($valueOrConfig)
 *
 ********************************************************************************************************************/

class NumberInput extends Input
{
    /**
     * DateInput constructor.
     * @param null $content
     * @throws \Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        $this->type = 'number';

        parent::__construct($content);
    }

    /**
     * Set step for input
     *
     * @param float $step
     *
     * @return NumberInput
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function step(float $step)
    {
        $this->attr('step', $step);

        return $this;
    }

    /**
     * Set max value
     *
     * @param float $max
     *
     * @return mixed|ContentFieldsUsableTrait|CreatesElements|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function max(float $max)
    {
        return $this->attr('max', $max);
    }

    /**
     * Set min value
     *
     * @param float $min
     *
     * @return mixed|ContentFieldsUsableTrait|CreatesElements|null
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function min(float $min)
    {
        return $this->attr('min', $min);
    }
}

<?php


namespace Webmagic\Dashboard\Components;

use Illuminate\Http\Request;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Forms\Form;

class TableFilterGenerator extends FormGenerator implements Renderable
{
    /** @var TablePageGenerator|TableGenerator */
    protected $tablePageGenerator;

    /**
     * FormGenerator constructor.
     *
     * @param TablePageGenerator|TableGenerator $tablePageGenerator
     * @param string                            $resultBlockId
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __construct(TableGenerator $tablePageGenerator, string $resultBlockId)
    {
        parent::__construct();

        $this->tablePageGenerator = $tablePageGenerator;

        $this->action(request()->url())
            ->method('GET')
            ->ajax(true)
            ->replaceBlockClass($resultBlockId)
            ->successNotification(false);

        $this->getForm()
            ->makeInline()
            ->statusMessage(false);

        // Make the form do not close the popup on submit (for the situation when table with filter use in a popup)
        $this->getForm()->doNotHidePopupOnSubmit();
    }

    /**
     * Add simple select filed to filter
     *
     * @param string  $key
     * @param array   $options
     * @param Request $request
     * @param string  $label
     *
     * @param bool    $withAny
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function simpleSelect(
        string $key,
        array $options,
        Request $request,
        string $label = '',
        bool $withAny = true
    ) {
        $name = "filter[$key]";
        $selectedRequestKey = "filter.$key";
        $options = $withAny ? array_prepend($options, 'Any', 'any') : $options;

        $this->selectJS($name, $options, $request->input($selectedRequestKey), $label);

        return $this;
    }

    /**
     * @return TablePageGenerator|TableGenerator
     */
    public function parent()
    {
        return $this->tablePageGenerator;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->tablePageGenerator->render();
    }

    /**
     * Convert current object to string
     *
     * @return string
     */
    public function __toString(): string
    {
        $this->render();
    }
}

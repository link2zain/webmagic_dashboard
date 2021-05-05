<?php


namespace Webmagic\Dashboard\Components;

use Illuminate\Http\Request;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;
use Webmagic\Dashboard\Elements\Forms\Form;

class FilterGenerator extends FormGenerator implements Renderable
{
    /** @var Renderable|null */
    protected $parent;

    /** @var Form */
    protected $filter;

    /**
     * FilterGenerator constructor.
     *
     * @param string          $filterUpdateBlockId
     * @param                 $parent
     * @param Form            $filter
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __construct(string $filterUpdateBlockId, Renderable $parent = null, Form $filter = null)
    {
        parent::__construct();

        $this->parent = $parent;
        $this->filter = $filter;

        $this->setDefaultFormConfig($filterUpdateBlockId);
    }

    /**
     * Apply default configuration rules to the form
     *
     * @param string $filterUpdateBlockId
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    protected function setDefaultFormConfig(string $filterUpdateBlockId)
    {
        $this->action(request()->url())
            ->method('GET')
            ->ajax(true)
            ->resultBlockClass($filterUpdateBlockId)
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
     * Return filter
     *
     * @return Form
     */
    public function getFilter(): Form
    {
        return $this->form;
    }

    /**
     * Return parent if needed
     *
     * @return CreatesElements|null
     */
    public function parent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->parent->render();
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

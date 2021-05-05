<?php


namespace Webmagic\Dashboard\Components;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Webmagic\Dashboard\Components\Core\UsePage;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Buttons\DefaultButton;
use Webmagic\Dashboard\Elements\Forms\Elements\ClearButton;
use Webmagic\Dashboard\Elements\Forms\Elements\FormGroup;
use Webmagic\Dashboard\Pages\BasePage;

class FormPageGenerator extends FormGenerator implements Renderable
{
    use UsePage;

    /** @var DefaultButton */
    protected $mainSubmitBtn;

    /**
     * FormPageGenerator constructor.
     *
     * @param BasePage $page
     *
     * @throws Exception
     */
    public function __construct(BasePage $page = null)
    {
        $this->setPage($page);

       $this->form = $this->getPage()->element()->form();

        $this->form->ajaxForm(true)->element()->box()->headerAvailable(false);

        $this->prepareMainSubmitButton();

        $this->addLinkButton(url()->previous(), 'Back', ' btn btn-default ml-2');
    }

    /**
     * Prepare main submit button
     *
     * @param string|null $title
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareMainSubmitButton(string $title = null)
    {
        $title = $title ?? trans('dashboard::common.forms.submit');

        $this->addSubmitButton([], $title, ' btn btn-primary float-right ml-2');

        $this->mainSubmitBtn = $this->getBox()->param('box_footer');
    }

    /**
     * Add additional submit button
     *
     * @param string $title
     * @param string $class
     * @param array  $attributes
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function addSubmitButton(
        array $attributes = [],
        string $title = '',
        string $class = ' btn btn-default float-right ml-2'
    ) {
        $btn = (new DefaultButton($title))->type('submit')->class($class);

        foreach ($attributes as $name => $val) {
            $btn->attr($name, $val);
        }

        $this->getBox()->addContent($btn, 'box_footer');

        return $this;
    }

    /**
     * Add clear button
     *
     * @param array  $attributes
     * @param string $title
     * @param string $class
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function addClearButton(
        array $attributes = [],
        string $title = '',
        string $class = ' btn btn-danger  float-right ml-2'
    ) {
        $btn = (new ClearButton())->value($title)->class($class);

        foreach ($attributes as $name => $val) {
            $btn->attr($name, $val);
        }

        $this->getBox()->addContent($btn, 'box_footer');

        return $this;
    }

    /**
     * Add link button
     *
     * @param string $link
     * @param string $title
     * @param string $class
     *
     * @param array  $attributes
     *
     * @return $this
     * @throws NoOneFieldsWereDefined
     */
    public function addLinkButton(
        string $link,
        string $title = '',
        string $class = ' btn btn-default float-right ml-2',
        array $attributes = []
    ) {
        $this->getBox()->addElement('box_footer')
            ->linkButton($title)
            ->class($class)
            ->link($link)
            ->attrs($attributes);

        return $this;
    }

    /**
     * Set submit button title
     *
     * @param string $title
     *
     * @return $this
     * @throws NoOneFieldsWereDefined
     */
    public function submitButtonTitle(string $title)
    {
        $this->mainSubmitBtn->content($title);

        return $this;
    }

    /**
     * Get form Box
     *
     * @return Box
     * @throws NoOneFieldsWereDefined
     */
    public function getBox()
    {
        return $this->getForm()->content();
    }

    /**
     * Add new form group
     *
     * @param string $labelTxt
     * @param string $labelId
     *
     * @return FormGroup
     * @throws NoOneFieldsWereDefined
     */
    protected function prepareNextFormGroup(string $labelTxt = '', string $labelId = '', string $class = 'clearfix')
    {
        return $this->getContentPart()->addElement()
            ->formGroup()->labelTxt($labelTxt)->labelId($labelId)->class($class);
    }

    /**
     * Return content part for adding elements
     *
     * @return Box|\Webmagic\Dashboard\Elements\Forms\Form|null
     * @throws NoOneFieldsWereDefined
     */
    protected function getContentPart()
    {
        return $this->getBox();
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render(): string
    {
        return $this->getPage()->render();
    }
}

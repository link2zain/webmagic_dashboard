<?php

namespace Webmagic\Dashboard\Elements\Factories;

use Webmagic\Dashboard\Elements\Badge;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup;
use Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink;
use Webmagic\Dashboard\Elements\Buttons\DefaultButton;
use Webmagic\Dashboard\Elements\WrapperDiv;
use Webmagic\Dashboard\Elements\WrapperSpan;
use Webmagic\Dashboard\Elements\Files\PhotoUploader;
use Webmagic\Dashboard\Elements\Forms\Elements\Color;
use Webmagic\Dashboard\Elements\Files\FilePreview;
use Webmagic\Dashboard\Elements\Files\ImageComponent;
use Webmagic\Dashboard\Elements\Files\ImageInput;
use Webmagic\Dashboard\Elements\Files\ImagePreview;
use Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown;
use Webmagic\Dashboard\Elements\Forms\Elements\SelectJS;
use Webmagic\Dashboard\Elements\Graphics\Graphic;
use Webmagic\Dashboard\Elements\Grid\Grid;
use Webmagic\Dashboard\Elements\Lists\DataList;
use Webmagic\Dashboard\Elements\Lists\DescriptionList;
use Webmagic\Dashboard\Elements\Forms\Elements\Checkbox;
use Webmagic\Dashboard\Elements\Forms\Elements\DateInput;
use Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput;
use Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker;
use Webmagic\Dashboard\Elements\Forms\Elements\FormGroup;
use Webmagic\Dashboard\Elements\Forms\Elements\Input;
use Webmagic\Dashboard\Elements\Forms\Elements\NumberInput;
use Webmagic\Dashboard\Elements\Forms\Elements\Select;
use Webmagic\Dashboard\Elements\Forms\Elements\Switcher;
use Webmagic\Dashboard\Elements\Forms\Elements\Textarea;
use Webmagic\Dashboard\Elements\Forms\Elements\TimeInput;
use Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor;
use Webmagic\Dashboard\Elements\Forms\Form;
use Webmagic\Dashboard\Elements\Icons\Icon;
use Webmagic\Dashboard\Elements\Links\LinkJSDelete;
use Webmagic\Dashboard\Elements\Notifications\Notification;
use Webmagic\Dashboard\Elements\Paginator;
use Webmagic\Dashboard\Elements\ProductBlock;
use Webmagic\Dashboard\Elements\StringElement;
use Webmagic\Dashboard\Elements\Tables\TableTitle;
use Webmagic\Dashboard\Elements\Tabs\Navigation;
use Webmagic\Dashboard\Elements\Tabs\Tab;
use Webmagic\Dashboard\Elements\Tabs\Tabs;
use Webmagic\Dashboard\Elements\Titles\H1Title;
use Webmagic\Dashboard\Elements\Titles\H4Title;
use Webmagic\Dashboard\Elements\Links\Link;
use Webmagic\Dashboard\Elements\Links\LinkButton;
use Webmagic\Dashboard\Elements\Tables\Table;
use Webmagic\Dashboard\Elements\Tables\TableRowsCollection;
use Webmagic\Dashboard\Pages\BasePage;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Pages\BasePage page($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Grid\Grid grid($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Icons\Icon icon($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Links\Link link($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Links\LinkJSDelete linkJsDeleteButton($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Links\LinkButton linkButton($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Files\ImagePreview imagePreview($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Files\ImageInput imageInput($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Files\ImageComponent imageComponent($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Files\FilePreview filePreview($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Files\PhotoUploader photoUploader($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Graphics\Graphic graphic($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\StringElement stringElement($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Boxes\Box box($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Lists\DescriptionList descriptionList($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Lists\DataList dataList($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Form form($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup formGroup($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Input input($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\NumberInput numberInput($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateInput dateInput($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\TimeInput timeInput($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimeInput dateTimeInput($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown dateDropdown($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker dateTimePicker($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Textarea textarea($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor visualEditor($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Checkbox checkbox($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Buttons\DefaultButton button($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Switcher switcher($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Select select($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\SelectJS selectJS($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\Color color($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tables\Table table($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tables\TableTitle tableTitle($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tables\TableRowsCollection tableRows($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Paginator paginator($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroup buttonGroup($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Buttons\ButtonGroup\ButtonGroupJsDeleteLink buttonGroupJsDeleteLink($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Titles\H1Title h1Title($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Titles\H4Title h4Title($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Badge badge($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\ProductBlock productBlock($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Notifications\Notification notification($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tabs tabs($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tabs\Tab tab($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\Tabs\Navigation tabsNavigation($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\WrapperDiv wrapperDiv($elementAttribute = null)
 * @method \Webmagic\Dashboard\Elements\WrapperSpan wrapperSpan($elementAttribute = null)
 *
 ********************************************************************************************************************/

class ElementsFactory implements ElementsRegisterAbleContract
{
    /** @var array Elements available for generation */
    protected $elements = [
        'page' => BasePage::class,

        'grid' => Grid::class,

        'icon' => Icon::class,

        'wrapperDiv' => WrapperDiv::class,
        'wrapperSpan' => WrapperSpan::class,

        'link' => Link::class,
        'linkJsDeleteButton' => LinkJSDelete::class,
        'linkButton' => LinkButton::class,

        'imagePreview' => ImagePreview::class,
        'imageInput' => ImageInput::class,
        'imageComponent' => ImageComponent::class,
        'filePreview' => FilePreview::class,
        'photoUploader' => PhotoUploader::class,

        'graphic' => Graphic::class,

        'stringElement' => StringElement::class,

        'box' => Box::class,

        'descriptionList' => DescriptionList::class,
        'dataList' => DataList::class,

        'form' => Form::class,
        'formGroup' => FormGroup::class,

        'input' => Input::class,
        'numberInput' => NumberInput::class,
        'dateInput' => DateInput::class,
        'timeInput' => TimeInput::class,
        'dateTimeInput' => DateTimeInput::class,
        'dateDropdown' => DateDropdown::class,
        'dateTimePicker' => DateTimePicker::class,
        'textarea' => Textarea::class,
        'visualEditor' => VisualEditor::class,
        'checkbox' => Checkbox::class,
        'button' => DefaultButton::class,
        //        'image' => Image::class,
        'switcher' => Switcher::class,
        'select' => Select::class,
        'selectJS' => SelectJS::class,
        'color' => Color::class,

        'table' => Table::class,
        'tableTitle' => TableTitle::class,
        'tableRows' => TableRowsCollection::class,
        'paginator' => Paginator::class,

        'buttonGroup' => ButtonGroup::class,
        'buttonGroupJsDeleteLink' => ButtonGroupJsDeleteLink::class,
        'h1Title' => H1Title::class,
        'h4Title' => H4Title::class,

        'badge' => Badge::class,
        'productBlock' => ProductBlock::class,
	    'notification' => Notification::class,

	    'tabs' => Tabs::class,
        'tab' => Tab::class,
        'tabsNavigation' => Navigation::class,
    ];

    /** @var CreatesElements */
    protected $currentContainer = null;

    /** @var string */
    protected $containerParam = null;

    /** @var bool Show if result element should be added to the container */
    protected $addElement = false;

    /**
     * @return CreatesElements
     */
    public function getCurrentContainer()
    {
        return $this->currentContainer;
    }

    /**
     * @return string
     */
    public function getContainerParam()
    {
        return $this->containerParam;
    }

    /**
     * @return bool
     */
    public function isAddElement(): bool
    {
        return $this->addElement;
    }

    /** @var array Stack with containers */
    protected $containersStack = [];

    /**
     * ElementsFactory constructor.
     *
     * @param CreatesElements $container
     * @param string|null     $containerParam
     * @param bool            $addElement
     */
    public function __construct(
        CreatesElements $container = null,
        string $containerParam = null,
        bool $addElement = false
    ) {
        $this->updateData($container, $containerParam, $addElement);
    }

    /**
     * Update factory data
     *
     * @param CreatesElements $container
     * @param string|null     $containerParam
     * @param bool            $addElement
     *
     * @return ElementsFactory
     */
    public function updateData(
        CreatesElements $container = null,
        string $containerParam = null,
        bool $addElement = false
    ) {
        $this->currentContainer = $container;
        $this->containerParam = $containerParam;
        $this->addElement = $addElement;

        if ($container) {
            $this->putContainer($container);
        }

        return $this;
    }

    /**
     *  Put container to the stack
     *
     * @param CreatesElements $container
     */
    public function putContainer(CreatesElements $container)
    {
        array_push($this->containersStack, $container);
    }

    /**
     * Return previous container in the stack and remove it from stack
     *
     * @return CreatesElements
     */
    public function getPreviousContainer()
    {
        return array_pop($this->containersStack);
    }


    /**
     * Set or get params on __call
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (!key_exists($name, $this->elements)) {
            throw new \Exception("Element $name not registered");
        }

        // Create and configure element
        $element = app($this->elements[$name]);
        if ($element instanceof ElementsRegisterAbleContract) {
            return new $this->elements[$name]($this);
        }


        if (count($arguments) > 1) {
            $element->content($arguments);
        } elseif (count($arguments) == 1) {
            $element->content($arguments[0]);
        }

        // Save factory for work parent link
        $this->addFactoryToElement($element);

        // Return element if no container defined
        if (is_null($this->currentContainer)) {
            return $element;
        }

        // Add to container
        if ($this->addElement) {
            return $this->currentContainer->addContent($element, $this->containerParam);
        }

        if (is_null($this->containerParam)) {
            return $this->currentContainer->content($element);
        }

        return $this->currentContainer->param($this->containerParam, $element);
    }

    /**
     * Save factory for work parent link
     *
     * @param $element
     */
    protected function addFactoryToElement(CreatesElements $element)
    {
        $element->setFactory($this);
    }

    /**
     * Return all registered elements
     *
     * @return array
     */
    public function getRegistered(): array
    {
        return $this->elements;
    }

    /**
     * Check if element registered
     *
     * @param string $key
     * @return bool
     */
    public function isRegistered(string $key): bool
    {
        return key_exists($key, $this->getRegistered());
    }
}

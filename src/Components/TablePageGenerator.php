<?php

namespace Webmagic\Dashboard\Components;

use Illuminate\Contracts\Support\Renderable;
use Webmagic\Dashboard\Components\Core\UsePage;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Links\LinkButton;
use Webmagic\Dashboard\Pages\BasePage;

class TablePageGenerator extends TableGenerator implements Renderable
{
    use UsePage;

    /** @var Box */
    protected $box;

    /** @var string */
    protected $createLink;

    /** @var Box element identifier */
    protected $boxIdentifier;

    /**
     * TablePageGenerator constructor.
     *
     * @param BasePage $page
     */
    public function __construct(BasePage $page = null)
    {
        $this->setPage($page);

        $this->box = $this->page->element()->box()
            ->footerAvailable(false)
            ->headerAvailable(false);

        $this->table = $this->box->element()->table();

        $this->setRowIdentifiersClosure();
        $this->setTableBlockIdentifier();
        $this->setBoxIdentifier();
    }

    /**
     * Add identifier for the box element
     */
    protected function setBoxIdentifier()
    {
        $this->boxIdentifier = 'js_box_identifier_' . uniqid();
        $this->getBox()->addClass(" $this->boxIdentifier ")->addBoxBodyClasses(' table-responsive ');
    }

    /**
     * @param string $link
     *
     * @return TablePageGenerator
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function createLink(string $link)
    {
        $this->createLink = $link;

        $this->updateTable();

        return $this;
    }

    /**
     * Add link button to tools area
     *
     * @param string $link
     * @param string $label
     * @param string $iconClass
     * @param string $buttonClass
     *
     * @return $this
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    public function addToolsLinkButton(
        string $link,
        string $label = '',
        string $iconClass = '',
        string $buttonClass = 'btn-default'
    ) {
        $this->getBox()->addToolsLinkButton($link, $label, $iconClass, $buttonClass);

        return $this;
    }

    /**
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined
     */
    protected function updateTable()
    {
        if ($this->shouldCreateButtonBeShown()) {
            $createBtn = (new LinkButton())
                ->icon('fas fa-plus')
                ->link($this->prepareCreateLink())
                ->content(__('dashboard::common.add'))
                ->class('btn-default');

            if ($this->toolsInModal) {
                $createBtn->addClass(' js_ajax-by-click-btn')
                    ->dataAttr('action', $this->prepareCreateLink())
                    ->dataAttr('modal', 'true')
                    ->dataAttr('method', 'GET')
                    ->dataAttr('replace-blk', ".$this->boxIdentifier");
            }

            $this->getBox()->headerAvailable(true)
                ->boxTools($createBtn);
        }

        parent::updateTable();
    }

    /**
     * Prepare create link
     *
     * @return string
     */
    protected function prepareCreateLink()
    {
        if (empty($this->createLink) && empty($this->resourceUrlsGeneratorGenerator)) {
            return '';
        }

        if (isset($this->createLink)) {
            return $this->createLink;
        }

        return ($this->resourceUrlsGeneratorGenerator)->createUrl();
    }

    /**
     * @return bool
     */
    protected function shouldCreateButtonBeShown()
    {
        return $this->createLink || $this->resourceUrlsGeneratorGenerator;
    }


    /**
     * @return Box
     *
     */
    public function getBox()
    {
        return $this->box;
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

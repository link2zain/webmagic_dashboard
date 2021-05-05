<?php


namespace Webmagic\Dashboard\Docs\Http;



use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Dashboard;
use Webmagic\Dashboard\Elements\Buttons\DefaultButton;
use Webmagic\Dashboard\Elements\Forms\Elements\FormGroup;
use Webmagic\Dashboard\Elements\Links\LinkButton;
use Webmagic\Dashboard\Elements\Forms\Elements\Input;

class JSActionsPresentationController
{
    /**
     * Tooltips functionality presentation
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function tooltips(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/js-actions/tooltips.md');

        $addTooltip = (new FormGroup())->labelTxt('Checkbox with tooltip')->element()->checkbox()->js()->tooltip()->regular('This is an input with tooltip')->parent();
        $hideAddedTooltip = (new FormGroup())->labelTxt('Checkbox with hidden tooltip')->element()->checkbox()->js()->tooltip()->regular('Hidden tooltip')->js()->tooltip()->hide()->parent();


        $dashboard->page()
            ->setPageTitle('Tooltips functionality')
            ->addElement()->tabs()->addTab()->title('Description')->content($content)->active()
            ->parent()->addTab()->title('Example')->content([$addTooltip, $hideAddedTooltip]);

        return $dashboard;
    }

    /**
     * Tooltips functionality presentation
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function confirmationPopup(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/js-actions/confirmation-popup.md');

        $btn = (new LinkButton())->content('Action element')
            ->js()->sendRequestOnClick()->regular(url()->current())
            ->js()->confirmationPopup()->regular(
                'Confirm this action',                          // title
                'Please, make sure you want to do this',        // content
                'I confirm',                                 // confirm button
                'Do not do this'                                // cancel button
            );

        $dashboard->page()
            ->setPageTitle('Confirm popup functionality')
            ->addElement()->box()->makeSimple()->content($content)
            ->parent()
            ->addElement()->box()->makeSimple()->content($btn);

        return $dashboard;
    }

    /**
     * Tooltips functionality presentation
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function contentCopyToClipboard(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/js-actions/content-copy-to-clipboard.md');

        $btn1 = (new DefaultButton())
            ->addClass('btnClass')
            ->attr('id', 'testId')
            ->js()
            ->contentCopy()
            ->getElementValueToClipboard('.btnClass')
            ->content('Copy this button value');

        $inputText = (new Input())
            ->id('id_of_other_element')
            ->addClass('class_of_other_element')
            ->value('Value');

        $btn2 = (new DefaultButton())->js()
            ->contentCopy()
            ->getElementValueToClipboard('#id_of_other_element')
            ->content('Copy value from other element');

        $btn3 = (new DefaultButton())->js()
            ->contentCopy()
            ->getCurrentElementAttrToClipboard('attribute value')
            ->content('Copy this button attribute value');

        $dashboard->page()
            ->addElement()->tabs()->addTab()->title('Description')->content($content)->active()
            ->parent()->addTab()->title('Example')->content([$btn1, '<br><br>',$inputText, '<br>', $btn2, '<br><br>', $btn3]);

        return $dashboard;
    }
}

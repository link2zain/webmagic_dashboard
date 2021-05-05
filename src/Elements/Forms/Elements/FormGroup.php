<?php


namespace Webmagic\Dashboard\Elements\Forms\Elements;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup labelId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup addLabelId($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup labelTxt($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup addLabelTxt($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup formGroupContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup addFormGroupContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup wrapField($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Elements\FormGroup addWrapField($valueOrConfig)
 *
 ********************************************************************************************************************/

class FormGroup extends ComplexElement
{
    protected $view = 'dashboard::elements.forms.elements.form_group';

    protected $available_fields = [
        'class',
        'label_id',
        'label_txt',
        'form_group_content',
        'wrap_field'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'form_group_content';

    /**
     * FormGroup constructor.
     *
     * @param null $content
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function __construct($content = null)
    {
        parent::__construct($content);

        //Set default input, if did not set
        if (empty($this->form_group_content)) {
            $this->setInput(new Input);
        }
    }

    /**
     * Set input param
     *
     * @param Input $input
     *
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function setInput(Input $input)
    {
        $id = $input->param('id');
        $this->param('label_id', $id);
        $this->form_group_content = $input;
    }
}

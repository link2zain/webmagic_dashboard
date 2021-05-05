<?php

namespace Webmagic\Dashboard\Elements\Forms;

use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Factories\CreatesElements;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Elements\Forms\Form class($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form action($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addAction($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form method($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form realMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addRealMethod($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form formContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addFormContent($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form horizontal(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addHorizontal(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form sendAllCheckbox(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addSendAllCheckbox(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form ajaxForm(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addAjaxForm(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form resultBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addResultBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form resultReplaceBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addResultReplaceBlockClass($valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form successNotifications(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addSuccessNotifications(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form errorNotifications(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addErrorNotifications(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form statusMessage(bool $valueOrConfig)
 * @method \Webmagic\Dashboard\Elements\Forms\Form addStatusMessage(bool $valueOrConfig)
 *
 ********************************************************************************************************************/

class Form extends ComplexElement
{
    protected $view = 'dashboard::components.form.form';

    protected $available_fields = [
        'class',
        'action' => [
            'default' => '/'
        ],
        'method' => [
            'acceptable_values' => [
                'GET',
                'POST',
                'PUT',
                'DELETE',
                'PATCH'
            ],
            'default' => 'POST'
        ],
        'realMethod' => [
            'acceptable_values' => [
                'GET',
                'POST',
                'PUT',
                'DELETE',
                'PATCH'
            ],
            'default' => 'POST'
        ],
        'form_content',
        'horizontal' => [
            'type' => 'bool',
            'default' => false
        ],
        'send_all_checkbox' => [
            'type' => 'bool',
            'default' => 'false'
        ],
        'ajax_form' => [
            'type' => 'bool',
            'default' => false
        ],
        'result_block_class',
        'result_replace_block_class',
        'success_notifications' => [
            'type' => 'bool',
            'default' => true
        ],
        'error_notifications' => [
            'type' => 'bool',
            'default' => true
        ],
        'status_message' => [
            'type' => 'bool',
            'default' => true
        ]
    ];

    protected $default_field = 'form_content';

    /**
     * Configure form ajax params
     *
     * @param bool   $status
     * @param string $resultBlockClass
     * @param string $resultReplaceBlockClass
     * @param bool   $successNotification
     * @param bool   $errorNotification
     *
     * @return mixed|ContentFieldsUsable|CreatesElements
     * @throws NoOneFieldsWereDefined
     */
    public function ajax(
        bool $status = true,
        string $resultBlockClass = '',
        string $resultReplaceBlockClass = '',
        bool $successNotification = true,
        bool $errorNotification = true
    ) {
        return $this->content([
            'ajax_form' => $status,
            'result_block_class' => $resultBlockClass,
            'result_replace_block_class' => $resultReplaceBlockClass,
            'success_notifications' => $successNotification,
            'error_notifications' => $errorNotification,
        ]);
    }

    /**
     * Prepare methods for correct work request with Laravel
     *
     * @return mixed
     * @throws NoOneFieldsWereDefined
     */
    public function getMethod()
    {
        if (isset($this->method)) {
            $this->realMethod = $this->method;
        }

        if (isset($this->method) && ($this->method == 'GET' || $this->method == 'POST')) {
            return $this->method;
        }

        return $this->getFieldDefaultValue('method');
    }

    /**
     * Prepare result block class
     *
     * @param string $class
     */
    protected function setResultBlockClass(string $class)
    {
        $this->result_block_class = strlen($class) ? str_start($class, '.') : '';
    }

    /**
     * Prepare result replace block class
     *
     * @param string $class
     */
    protected function setResultReplaceBlockClass(string $class)
    {
        $this->result_replace_block_class = strlen($class) ? str_start($class, '.') : '';
    }

    /**
     * Make form inline
     */
    public function makeInline()
    {
        $this->addClass('form-inline');
        $this->horizontal(false);

        return $this;
    }

    /**
     * Add possibility to not hide the popup on submit
     * For the situation when form submits in a popup
     *
     * @param bool $doNotHidePopup
     *
     * @return $this
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function doNotHidePopupOnSubmit(bool $doNotHidePopup = false)
    {
        $this->attr('data-modal-hide', $doNotHidePopup);

        return $this;
    }
}

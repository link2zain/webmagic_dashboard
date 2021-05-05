<?php


namespace Webmagic\Dashboard\Pages;

use Webmagic\Dashboard\Components\FormGenerator;
use Webmagic\Dashboard\Core\ComplexElement;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Elements\Forms\Form;

class LoginPage extends ComplexElement
{
    /** @var  string Component view name */
    protected $view = 'dashboard::pages.login';

    /** @var  array Sections available in page */
    protected $available_fields = [
        'title' => [
            'default' => 'Login'
        ],
        'logo_link' => [
            'default' => '/'
        ],
        'register_link',
        'forgot_password_link',
        'before_form',
        'form' => [
            'type' => Form::class
        ],
        'after_form',
        'class'
    ];

    /** @var  string Default section for current component */
    protected $default_field = 'before_form';

    /**
     * Prepare default form
     *
     * @param string $action
     *
     * @return LoginPage
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function setDefaultForm(string $action = 'login')
    {
        $form = new FormGenerator();
        $form
            ->action(url($action))
            ->ajax(false)
            ->emailInput('email', old(), trans('dashboard::common.login_page.email'), true)
            ->passwordInput('password', null, trans('dashboard::common.login_page.password'), true)
            ->submitButton(trans('dashboard::common.login_page.log_in'));

        $this->param('form', $form->getForm());

        return $this;
    }
}
